<?php
namespace Controllers;

require_once __DIR__ . '/../models/Categoria.php';
use Models\Categoria;

class CategoriaController {

    // Chama a tela que exibe a lista de categorias
    public function index() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        
        // Proteção: Só logados entram
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: views/auth/login.php');
            exit;
        }

        $categorias = Categoria::listarTodas();
        // Inclui a tela passando a lista de categorias para ela
        require_once __DIR__ . '/../../views/categorias/index.php';
    }

    // Processa o formulário de criação de nova categoria
    public function armazenar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

            if (!empty($nome)) {
                Categoria::criar($nome, $descricao);
            }

            // Recarrega a página de categorias
            header('Location: index.php?action=categorias');
            exit;
        }
    }
}