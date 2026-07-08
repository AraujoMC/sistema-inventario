<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php'); // Ajustado o caminho para voltar à pasta auth
    exit;
}
?>
<span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
<span>Perfil: <?= htmlspecialchars($_SESSION['usuario_perfil']) ?></span>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['nome']) ?></span>
        <span>Perfil: <?= htmlspecialchars($_SESSION['perfil']) ?></span>
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