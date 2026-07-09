<?php
namespace Controllers;

require_once __DIR__ . '/../models/User.php';
use Models\User;

class PerfilUsuarioController {

    private function protegerRota() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: views/auth/login.php');
            exit;
        }
    }

    public function mostrar() {
        $this->protegerRota();
        $utilizador = User::buscarPorId($_SESSION['usuario_id']);
        require_once __DIR__ . '/../views/perfil/mostrar.php';
    }

    public function atualizarDados() {
        $this->protegerRota();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

            if (!empty($nome) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $utilizador = User::buscarPorId($_SESSION['usuario_id']);
                User::atualizar($_SESSION['usuario_id'], $nome, $email, $utilizador['perfil_id']);
                $_SESSION['usuario_nome'] = $nome;
                $_SESSION['msg_perfil'] = "Dados actualizados com sucesso.";
            } else {
                $_SESSION['erro_perfil'] = "Preenche um nome e um email válidos.";
            }
            header('Location: index.php?action=meu-perfil');
            exit;
        }
    }

    public function alterarSenha() {
        $this->protegerRota();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $senhaAtual = $_POST['senha_atual'] ?? '';
            $novaSenha  = $_POST['nova_senha'] ?? '';

            $utilizador = User::buscarPorId($_SESSION['usuario_id']);

            if ($utilizador && password_verify($senhaAtual, $utilizador['senha']) && strlen($novaSenha) >= 6) {
                $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
                User::atualizarSenha($_SESSION['usuario_id'], $hash);
                $_SESSION['msg_perfil'] = "Senha alterada com sucesso.";
            } else {
                $_SESSION['erro_perfil'] = "Senha actual incorrecta ou nova senha demasiado curta (mínimo 6 caracteres).";
            }
            header('Location: index.php?action=meu-perfil');
            exit;
        }
    }
}
