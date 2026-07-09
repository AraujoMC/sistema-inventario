<?php
namespace Controllers;

require_once __DIR__ . '/../models/Relatorio.php';
use Models\Relatorio;

class RelatorioController {

    private function protegerRota() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: views/auth/login.php');
            exit;
        }
    }

    public function index() {
        $this->protegerRota();
        $totais = Relatorio::totais();
        require_once __DIR__ . '/../views/relatorios/index.php';
    }

    public function produtos() {
        $this->protegerRota();
        $produtos = Relatorio::produtosCadastrados();
        require_once __DIR__ . '/../views/relatorios/produtos.php';
    }

    public function stockBaixo() {
        $this->protegerRota();
        $produtos = Relatorio::stockBaixo();
        require_once __DIR__ . '/../views/relatorios/stock_baixo.php';
    }

    public function movimentacoes() {
        $this->protegerRota();
        $linhas = Relatorio::movimentacoesPorMes();
        require_once __DIR__ . '/../views/relatorios/movimentacoes.php';
    }
}
