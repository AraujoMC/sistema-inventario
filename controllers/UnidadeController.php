<?php
namespace Controllers;

require_once __DIR__ . '/../models/Unidade.php';
use Models\Unidade;

class UnidadeController {

    private function protegerRota() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: views/auth/login.php');
            exit;
        }
    }

    public function index() {
        $this->protegerRota();
        $unidades = Unidade::listarTodas();
        require_once __DIR__ . '/../views/unidades/listar.php';
    }

    public function novo() {
        $this->protegerRota();
        require_once __DIR__ . '/../views/unidades/criar.php';
    }

    public function armazenar() {
        $this->protegerRota();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $sigla = filter_input(INPUT_POST, 'sigla', FILTER_SANITIZE_SPECIAL_CHARS);

            if (!empty($nome) && !empty($sigla)) {
                Unidade::criar($nome, $sigla);
            }
            header('Location: index.php?action=unidades');
            exit;
        }
    }

    public function editar() {
        $this->protegerRota();
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php?action=unidades'); exit; }

        $unidade = Unidade::buscarPorId($id);
        if (!$unidade) { header('Location: index.php?action=unidades'); exit; }

        require_once __DIR__ . '/../views/unidades/editar.php';
    }

    public function atualizar() {
        $this->protegerRota();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $sigla = filter_input(INPUT_POST, 'sigla', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($id && !empty($nome) && !empty($sigla)) {
                Unidade::atualizar($id, $nome, $sigla);
            }
            header('Location: index.php?action=unidades');
            exit;
        }
    }

    public function apagar() {
        $this->protegerRota();
        $id = $_GET['id'] ?? null;
        if ($id) {
            Unidade::apagar($id);
        }
        header('Location: index.php?action=unidades');
        exit;
    }
}
