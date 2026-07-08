<?php
namespace Controllers;

require_once __DIR__ . '/../models/Categoria.php';
use Models\Categoria;

class CategoriaController {

    private function protegerRota() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: views/auth/login.php');
            exit;
        }
    }

    // Lista todas as categorias
    public function index() {
        $this->protegerRota();
        $categorias = Categoria::listarTodas();
        require_once __DIR__ . '/../views/categorias/listar.php';
    }

    // Mostra o formulário de criação (GET)
    public function novo() {
        $this->protegerRota();
        require_once __DIR__ . '/../views/categorias/criar.php';
    }

    // Processa o formulário de criação (POST)
    public function armazenar() {
        $this->protegerRota();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

            if (!empty($nome)) {
                Categoria::criar($nome, $descricao);
            }
            header('Location: index.php?action=categorias');
            exit;
        }
    }

    // Mostra o formulário de edição (GET)
    public function editar() {
        $this->protegerRota();
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php?action=categorias'); exit; }

        $categoria = Categoria::buscarPorId($id);
        if (!$categoria) { header('Location: index.php?action=categorias'); exit; }

        require_once __DIR__ . '/../views/categorias/editar.php';
    }

    // Processa o formulário de edição (POST)
    public function atualizar() {
        $this->protegerRota();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($id && !empty($nome)) {
                Categoria::atualizar($id, $nome, $descricao);
            }
            header('Location: index.php?action=categorias');
            exit;
        }
    }

    // Elimina uma categoria
    public function apagar() {
        $this->protegerRota();
        $id = $_GET['id'] ?? null;
        if ($id) {
            Categoria::apagar($id);
        }
        header('Location: index.php?action=categorias');
        exit;
    }
}
