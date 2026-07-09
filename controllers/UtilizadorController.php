<?php
namespace Controllers;

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Perfil.php';
use Models\User;
use Models\Perfil;

class UtilizadorController {

    private function protegerRota() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: views/auth/login.php');
            exit;
        }
    }

    // Só Administrador (perfil_id 1) pode gerir utilizadores
    private function protegerAdmin() {
        $this->protegerRota();
        if ((int) $_SESSION['usuario_perfil'] !== 1) {
            $_SESSION['erro_acesso'] = "Acesso restrito ao Administrador.";
            header('Location: index.php?action=dashboard');
            exit;
        }
    }

    public function index() {
        $this->protegerAdmin();
        $utilizadores = User::listarTodos();
        require_once __DIR__ . '/../views/utilizadores/listar.php';
    }

    public function novo() {
        $this->protegerAdmin();
        $perfis = Perfil::listarTodos();
        require_once __DIR__ . '/../views/utilizadores/criar.php';
    }

    public function armazenar() {
        $this->protegerAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'] ?? '';
            $perfilId = filter_input(INPUT_POST, 'perfil_id', FILTER_VALIDATE_INT);

            if (!empty($nome) && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($senha) >= 6) {
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                User::criar($nome, $email, $senhaHash, $perfilId);
            }
            header('Location: index.php?action=utilizadores');
            exit;
        }
    }

    public function editar() {
        $this->protegerAdmin();
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php?action=utilizadores'); exit; }

        $utilizador = User::buscarPorId($id);
        if (!$utilizador) { header('Location: index.php?action=utilizadores'); exit; }

        $perfis = Perfil::listarTodos();
        require_once __DIR__ . '/../views/utilizadores/editar.php';
    }

    public function atualizar() {
        $this->protegerAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'] ?? '';
            $perfilId = filter_input(INPUT_POST, 'perfil_id', FILTER_VALIDATE_INT);

            $senhaHash = !empty($senha) ? password_hash($senha, PASSWORD_DEFAULT) : null;

            if ($id && !empty($nome) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                User::atualizar($id, $nome, $email, $perfilId, $senhaHash);
            }
            header('Location: index.php?action=utilizadores');
            exit;
        }
    }

    public function apagar() {
        $this->protegerAdmin();
        $id = $_GET['id'] ?? null;
        // Impede que o utilizador se apague a si próprio (evita ficar sem admins)
        if ($id && $id != $_SESSION['usuario_id']) {
            User::apagar($id);
        }
        header('Location: index.php?action=utilizadores');
        exit;
    }
}
