<?php
namespace Controllers;

require_once __DIR__ . '/../models/Movimento.php';
require_once __DIR__ . '/../models/Produto.php';
use Models\Movimento;
use Models\Produto;

class MovimentoController {

    private function protegerRota() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: views/auth/login.php');
            exit;
        }
    }

    public function index() {
        $this->protegerRota();
        $movimentos = Movimento::listarTodos();
        require_once __DIR__ . '/../views/movimentos/listar.php';
    }

    public function novo() {
        $this->protegerRota();
        $produtos = Produto::listarTodas();
        require_once __DIR__ . '/../views/movimentos/criar.php';
    }

    public function armazenar() {
        $this->protegerRota();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produtoId = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
            $tipo = $_POST['tipo'] ?? '';
            $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
            $data = $_POST['data'] ?? date('Y-m-d');
            $motivo = filter_input(INPUT_POST, 'motivo', FILTER_SANITIZE_SPECIAL_CHARS);

            $tipoValido = in_array($tipo, ['entrada', 'saida'], true);

            if ($produtoId && $tipoValido && $quantidade > 0) {
                Movimento::registar($produtoId, $_SESSION['usuario_id'], $tipo, $quantidade, $motivo, $data);
            }
            header('Location: index.php?action=movimentos');
            exit;
        }
    }
}
