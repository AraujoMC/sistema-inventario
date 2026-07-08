<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'controllers/AuthController.php';
require_once 'controllers/CategoriaController.php';
require_once 'controllers/UnidadeController.php';
require_once 'controllers/LocalizacaoController.php';

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

    default:
        if (isset($_SESSION['usuario_id'])) {
            header('Location: index.php?action=dashboard');
        } else {
            header('Location: views/auth/login.php');
        }
        exit;
}
