<?php
namespace Controllers;

require_once __DIR__ . '/../models/Localizacao.php';
use Models\Localizacao;

class LocalizacaoController {

    private function protegerRota() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: views/auth/login.php');
            exit;
        }
    }

    public function index() {
        $this->protegerRota();
        $localizacoes = Localizacao::listarTodas();
        require_once __DIR__ . '/../views/localizacoes/listar.php';
    }

    public function novo() {
        $this->protegerRota();
        require_once __DIR__ . '/../views/localizacoes/criar.php';
    }

    public function armazenar() {
        $this->protegerRota();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

            if (!empty($nome) && !empty($codigo)) {
                Localizacao::criar($codigo, $nome);
            }
            header('Location: index.php?action=localizacoes');
            exit;
        }
    }

    public function editar() {
        $this->protegerRota();
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php?action=localizacoes'); exit; }

        $localizacao = Localizacao::buscarPorId($id);
        if (!$localizacao) { header('Location: index.php?action=localizacoes'); exit; }

        require_once __DIR__ . '/../views/localizacoes/editar.php';
    }

    public function atualizar() {
        $this->protegerRota();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($id && !empty($nome) && !empty($codigo)) {
                Localizacao::atualizar($id, $codigo, $nome);
            }
            header('Location: index.php?action=localizacoes');
            exit;
        }
    }

    public function apagar() {
        $this->protegerRota();
        $id = $_GET['id'] ?? null;
        if ($id) {
            Localizacao::apagar($id);
        }
        header('Location: index.php?action=localizacoes');
        exit;
    }
}
