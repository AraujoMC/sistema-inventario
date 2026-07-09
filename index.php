<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'controllers/AuthController.php';
require_once 'controllers/CategoriaController.php';
require_once 'controllers/UnidadeController.php';
require_once 'controllers/LocalizacaoController.php';
require_once 'controllers/ProdutoController.php';
require_once 'controllers/MovimentoController.php';
require_once 'controllers/UtilizadorController.php';
require_once 'controllers/RelatorioController.php';

$action = $_GET['action'] ?? '';

switch ($action) {

    // ---------- Autenticação ----------
    case 'login':
        $auth = new \Controllers\AuthController();
        $auth->autenticar();
        break;

    case 'logout':
        $auth = new \Controllers\AuthController();
        $auth->logout();
        break;

    case 'recuperar-senha':
        $auth = new \Controllers\AuthController();
        $auth->solicitarRecuperacao();
        break;

    case 'redefinir-senha':
        $auth = new \Controllers\AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->redefinirSenha();
        } else {
            $auth->mostrarRedefinir();
        }
        break;

    case 'dashboard':
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: views/auth/login.php');
            exit;
        }
        require_once __DIR__ . '/views/dashboard/index.php';
        break;

    // ---------- Categorias ----------
    case 'categorias':
        (new \Controllers\CategoriaController())->index();
        break;
    case 'categoria-nova':
        (new \Controllers\CategoriaController())->novo();
        break;
    case 'nova-categoria':
        (new \Controllers\CategoriaController())->armazenar();
        break;
    case 'categoria-editar':
        (new \Controllers\CategoriaController())->editar();
        break;
    case 'editar_categoria':
        (new \Controllers\CategoriaController())->atualizar();
        break;
    case 'apagar_categoria':
        (new \Controllers\CategoriaController())->apagar();
        break;

    // ---------- Unidades de medida ----------
    case 'unidades':
        (new \Controllers\UnidadeController())->index();
        break;
    case 'unidade-nova':
        (new \Controllers\UnidadeController())->novo();
        break;
    case 'nova-unidade':
        (new \Controllers\UnidadeController())->armazenar();
        break;
    case 'unidade-editar':
        (new \Controllers\UnidadeController())->editar();
        break;
    case 'editar_unidade':
        (new \Controllers\UnidadeController())->atualizar();
        break;
    case 'apagar_unidade':
        (new \Controllers\UnidadeController())->apagar();
        break;

    // ---------- Localizações ----------
    case 'localizacoes':
        (new \Controllers\LocalizacaoController())->index();
        break;
    case 'localizacao-nova':
        (new \Controllers\LocalizacaoController())->novo();
        break;
    case 'nova-localizacao':
        (new \Controllers\LocalizacaoController())->armazenar();
        break;
    case 'localizacao-editar':
        (new \Controllers\LocalizacaoController())->editar();
        break;
    case 'editar_localizacao':
        (new \Controllers\LocalizacaoController())->atualizar();
        break;
    case 'apagar_localizacao':
        (new \Controllers\LocalizacaoController())->apagar();
        break;

    // ---------- Produtos ----------
    case 'produtos':
        (new \Controllers\ProdutoController())->index();
        break;
    case 'produto-novo':
        (new \Controllers\ProdutoController())->novo();
        break;
    case 'criar_produto':
        (new \Controllers\ProdutoController())->armazenar();
        break;
    case 'produto-editar':
        (new \Controllers\ProdutoController())->editar();
        break;
    case 'editar_produto':
        (new \Controllers\ProdutoController())->atualizar();
        break;
    case 'apagar_produto':
        (new \Controllers\ProdutoController())->apagar();
        break;

    // ---------- Movimentos de stock ----------
    case 'movimentos':
        (new \Controllers\MovimentoController())->index();
        break;
    case 'movimento-novo':
        (new \Controllers\MovimentoController())->novo();
        break;
    case 'criar_movimento':
        (new \Controllers\MovimentoController())->armazenar();
        break;

    // ---------- Utilizadores ----------
    case 'utilizadores':
        (new \Controllers\UtilizadorController())->index();
        break;
    case 'utilizador-novo':
        (new \Controllers\UtilizadorController())->novo();
        break;
    case 'criar_utilizador':
        (new \Controllers\UtilizadorController())->armazenar();
        break;
    case 'utilizador-editar':
        (new \Controllers\UtilizadorController())->editar();
        break;
    case 'editar_utilizador':
        (new \Controllers\UtilizadorController())->atualizar();
        break;
    case 'apagar_utilizador':
        (new \Controllers\UtilizadorController())->apagar();
        break;

    // ---------- Relatórios ----------
    case 'relatorios':
        (new \Controllers\RelatorioController())->index();
        break;
    case 'relatorio-produtos':
        (new \Controllers\RelatorioController())->produtos();
        break;
    case 'relatorio-stock-baixo':
        (new \Controllers\RelatorioController())->stockBaixo();
        break;
    case 'relatorio-movimentacoes':
        (new \Controllers\RelatorioController())->movimentacoes();
        break;

    default:
        if (isset($_SESSION['usuario_id'])) {
            header('Location: index.php?action=dashboard');
        } else {
            header('Location: views/auth/login.php');
        }
        exit;
}
