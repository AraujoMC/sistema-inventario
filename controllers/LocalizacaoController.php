<?php
namespace Controllers;

require_once __DIR__ . '/../models/Localizacao.php';
use Models\Localizacao;

class LocalizacaoController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: views/auth/login.php');
            exit;
        }

        $localizacoes = Localizacao::listarTodas();
        require_once __DIR__ . '/../../views/localizacoes/index.php';
    }

    public function armazenar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

            if (!empty($nome)) {
                Localizacao::criar($nome, $descricao);
            }

            header('Location: index.php?action=localizacoes');
            exit;
        }
    }
}