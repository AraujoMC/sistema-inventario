<?php
// sistema-inventario/index.php (NA RAIZ DO PROJETO)

// 1. Inicia a sessão global do sistema para que as mensagens de erro e dados do utilizador funcionem
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Inclui o arquivo do controlador (verifique se o caminho da pasta backend está correto)
require_once 'controllers/AuthController.php';

// 3. Captura a ação enviada pela URL (ex: ?action=login)
$action = $_GET['action'] ?? '';

// 4. O Maestro entra em ação: decide para onde enviar o utilizador
switch ($action) {
    case 'login':
        // Instancia o controlador usando o Namespace que definiu no seu código
        $auth = new \Controllers\AuthController();
        $auth->autenticar();
        break;

    case 'logout':
        $auth = new \Controllers\AuthController();
        $auth->logout();
        break;

    default:
        // Se o utilizador apenas digitou http://localhost/sistema-inventario/,
        // o sistema envia-o automaticamente para a tela de login.
        header('Location: views/auth/login.php');
        exit;
}