<?php
namespace Controllers;
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/RecuperacaoSenha.php';
use Models\User;
use Models\RecuperacaoSenha;

class AuthController {
   public function autenticar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $semail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'] ?? '';

            $usuario = User::buscarPorEmail($semail);

            if ($usuario) {
                // BLINDAGEM: Descobre se o banco devolveu um Objeto ou um Array
                $senhaBanco = is_object($usuario) ? $usuario->senha : ($usuario['senha'] ?? null);
                $idBanco    = is_object($usuario) ? $usuario->id    : ($usuario['id'] ?? null);
                $nomeBanco  = is_object($usuario) ? $usuario->nome  : ($usuario['nome'] ?? null);
                $perfilBanco= is_object($usuario) ? $usuario->perfil_id : ($usuario['perfil_id'] ?? null);

                // Valida a senha usando a variável blindada
                if ($senhaBanco && password_verify($senha, $senhaBanco)) {
                    $_SESSION['usuario_id'] = $idBanco;
                    $_SESSION['usuario_nome'] = $nomeBanco;
                    $_SESSION['usuario_perfil'] = $perfilBanco;
                    
                    session_write_close();
                    header('Location: index.php?action=dashboard');
                    exit;
                }
            }

            // Se chegou aqui, é porque o utilizador não existe ou a senha falhou
            $_SESSION['erro_login'] = "Email ou senha incorretos.";
            session_write_close();
            header('Location: views/auth/login.php');
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: views/auth/login.php');
        exit;
    }

    // PASSO 1: pede o email e gera um token (simulado — mostrado no ecrã em vez de enviado por email)
    public function solicitarRecuperacao() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $usuario = User::buscarPorEmail($email);

            if ($usuario) {
                $id = is_object($usuario) ? $usuario->id : $usuario['id'];
                $token = bin2hex(random_bytes(16));
                RecuperacaoSenha::criar($id, $token);
                $_SESSION['token_simulado'] = $token;
            }

            // Por segurança, a mensagem é sempre igual, exista ou não o email
            $_SESSION['msg_recuperacao'] = "Se o email existir, foi gerado um link de recuperação.";
            header('Location: views/auth/recuperar.php');
            exit;
        }
    }

    // Mostra o formulário de nova senha (GET, a partir do link do email/simulação)
    public function mostrarRedefinir() {
        $token = $_GET['token'] ?? '';
        require_once __DIR__ . '/../views/auth/redefinir.php';
    }

    // PASSO 2: valida o token e grava a nova senha
    public function redefinirSenha() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'] ?? '';
            $novaSenha = $_POST['nova_senha'] ?? '';

            $registo = RecuperacaoSenha::buscarPorToken($token);

            if ($registo && strlen($novaSenha) >= 6) {
                $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
                User::atualizarSenha($registo['utilizador_id'], $hash);
                RecuperacaoSenha::marcarUsado($registo['id']);
                $_SESSION['msg_login'] = "Senha redefinida com sucesso. Podes iniciar sessão.";
            } else {
                $_SESSION['msg_login'] = "Token inválido ou senha demasiado curta.";
            }

            header('Location: views/auth/login.php');
            exit;
        }
    }
}