<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'controllers/AuthController.php';

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

    default:
        header('Location: views/auth/login.php');
        exit;
}