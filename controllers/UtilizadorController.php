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

    public function index() {
        $this->protegerRota();
        $utilizadores = User::listarTodos();
        require_once __DIR__ . '/../views/utilizadores/listar.php';
    }

    public function novo() {
        $this->protegerRota();
        $perfis = Perfil::listarTodos();
        require_once __DIR__ . '/../views/utilizadores/criar.php';
    }

    public function armazenar() {
        $this->protegerRota();
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
        $this->protegerRota();
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php?action=utilizadores'); exit; }

        $utilizador = User::buscarPorId($id);
        if (!$utilizador) { header('Location: index.php?action=utilizadores'); exit; }

        $perfis = Perfil::listarTodos();
        require_once __DIR__ . '/../views/utilizadores/editar.php';
    }

    public function atualizar() {
        $this->protegerRota();
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
        $this->protegerRota();
        $id = $_GET['id'] ?? null;
        // Impede que o utilizador se apague a si próprio (evita ficar sem admins)
        if ($id && $id != $_SESSION['usuario_id']) {
            User::apagar($id);
        }
        header('Location: index.php?action=utilizadores');
        exit;
    }
}
