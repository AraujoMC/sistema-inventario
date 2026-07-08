<?php
namespace Controllers;
use Models\User;

class AuthController {

    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $semail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'] ?? '';

            $usuario = User::buscarPorEmail($semail);
            if ($usuario && password_verify($senha, $usuario->senha)) {
                $_SESSION['usuario_id'] = $usuario->id;
                $_SESSION['usuario_nome'] = $usuario->nome;
                $_SESSION['usuario_perfil'] = $usuario->perfil_id;
                header('Location: ../views/dashboard');
                exit;
            } else {
                $_SESSION['erro_login'] = "Email ou senha incorretos.";
                header('Location: ../views/login');
                exit;
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../views/login');
        exit;
    }
}