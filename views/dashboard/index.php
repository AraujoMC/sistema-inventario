<?php
// views/dashboard/index.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Segurança de Negócio: Se o utilizador não estiver logado, manda de volta para o login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

// Pegamos as variáveis corretas que o AuthController gravou
$nomeUsuario   = $_SESSION['usuario_nome'];
$perfilUsuario = $_SESSION['usuario_perfil'];
?>

<div class="header">
    <p>Bem-vindo, <?= htmlspecialchars($nomeUsuario) ?></p> 
    
    <p>Perfil: <?= htmlspecialchars($perfilUsuario) ?></p> 
    
    <a href="../../index.php?action=logout">Sair</a>
</div>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($nomeUsuario) ?></span>
        <span>Perfil: <?= htmlspecialchars($perfilUsuario) ?></span>
        <a href="../index.php?action=logout">Sair</a>
    </header>

    <nav>
        <a href="produtos.php">Produtos</a>
        <a href="categorias.php">Categorias</a>
        <a href="relatorios.php">Relatórios</a>
    </nav>

    <main>
        <!-- aqui entra o conteúdo específico de cada página do CRUD -->
    </main>
</body>
</html>