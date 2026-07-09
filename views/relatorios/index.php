<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatórios</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <nav>
        <a href="index.php?action=dashboard">Dashboard</a>
        <a href="index.php?action=produtos">Produtos</a>
        <a href="index.php?action=movimentos">Movimentos</a>
        <a href="index.php?action=relatorios">Relatórios</a>
    </nav>

    <main>
        <h1>Relatórios</h1>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>Total de Produtos</h3>
                <p><?= (int) $totais['produtos'] ?></p>
            </div>
            <div class="dashboard-card">
                <h3>Total de Utilizadores</h3>
                <p><?= (int) $totais['utilizadores'] ?></p>
            </div>
            <div class="dashboard-card">
                <h3>Total de Categorias</h3>
                <p><?= (int) $totais['categorias'] ?></p>
            </div>
            <div class="dashboard-card">
                <h3>Produtos com Stock Baixo</h3>
                <p><?= (int) $totais['stock_baixo'] ?></p>
            </div>
        </div>

        <ul>
            <li><a href="index.php?action=relatorio-produtos">Relatório: Produtos Cadastrados</a></li>
            <li><a href="index.php?action=relatorio-stock-baixo">Relatório: Produtos com Stock Baixo</a></li>
            <li><a href="index.php?action=relatorio-movimentacoes">Relatório: Movimentações por Mês</a></li>
        </ul>
    </main>
</body>
</html>
