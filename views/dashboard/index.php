<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: views/auth/login.php');
    exit;
}

$nomeUsuario   = $_SESSION['usuario_nome'];
$perfilUsuario = $_SESSION['usuario_perfil'];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($nomeUsuario) ?></span>
        <span>Perfil: <?= htmlspecialchars($perfilUsuario) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <nav>
        <a href="index.php?action=dashboard">Dashboard</a>
        <a href="index.php?action=produtos">Produtos</a>
        <a href="index.php?action=categorias">Categorias</a>
        <a href="index.php?action=localizacoes">Localizações</a>
        <a href="index.php?action=unidades">Unidades</a>
        <a href="index.php?action=movimentos">Movimentos</a>
        <a href="index.php?action=utilizadores">Utilizadores</a>
    </nav>

    <main>
        <h1>Sistema de Gestão de Inventário</h1>
        <p>Escolha uma opção no menu para começar.</p>
    </main>
</body>
</html>
