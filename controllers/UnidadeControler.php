<?php
namespace Controllers;

require_once __DIR__ . '/../models/Unidade.php';
use Models\Unidade;

class UnidadeController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: views/auth/login.php');
            exit;
        }

        $unidades = Unidade::listarTodas();
        require_once __DIR__ . '/../../views/unidades/index.php';
    }

    public function armazenar() {
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
}