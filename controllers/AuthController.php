<?php
namespace Controllers;
require_once __DIR__ . '/../models/User.php';
use Models\User;

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
                    header('Location: views/dashboard/index.php');
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
}