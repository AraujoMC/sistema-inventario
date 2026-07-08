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
    case 'login':
        $auth = new \Controllers\AuthController();
        $auth->autenticar();
        break;

    case 'logout':
        $auth = new \Controllers\AuthController();
        $auth->logout();
        break;

    case 'categorias':
        $controller = new \Controllers\CategoriaController();
        $controller->index();
        break;

    case 'nova-categoria':
        $controller = new \Controllers\CategoriaController();
        $controller->armazenar();
        break;

    case 'unidades':
        $controller = new \Controllers\UnidadeController();
        $controller->index();
        break;
    case 'nova-unidade':
        $controller = new \Controllers\UnidadeController();
        $controller->armazenar();
        break;

    // Rotas de Localizações
    case 'localizacoes':
        $controller = new \Controllers\LocalizacaoController();
        $controller->index();
        break;
    case 'nova-localizacao':
        $controller = new \Controllers\LocalizacaoController();
        $controller->armazenar();
        break;

    default:
        header('Location: views/auth/login.php');
        exit;
}