<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nomeUsuario   = $_SESSION['usuario_nome'];
$perfilUsuario = $_SESSION['usuario_perfil'];
$ehAdmin       = ((int) $perfilUsuario === 1);

$erroAcesso = $_SESSION['erro_acesso'] ?? null;
unset($_SESSION['erro_acesso']);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistema de Inventário</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($nomeUsuario) ?></span>
        <a href="index.php?action=meu-perfil">Meu Perfil</a>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <nav>
        <a href="index.php?action=dashboard">Dashboard</a>
        <a href="index.php?action=produtos">Produtos</a>
        <a href="index.php?action=categorias">Categorias</a>
        <a href="index.php?action=localizacoes">Localizações</a>
        <a href="index.php?action=unidades">Unidades</a>
    </nav>

    <main>
        <?php if ($erroAcesso): ?>
            <p class="erro"><?= htmlspecialchars($erroAcesso) ?></p>
        <?php endif; ?>
        <div class="dashboard-boas-vindas">
            <h1>Sistema de Gestão de Inventário</h1>
            <p>Escolhe uma opção abaixo para começar.</p>
        </div>

        <div class="dashboard-grid">
            <a href="index.php?action=produtos" class="dashboard-card">
                <div class="dashboard-icone">📦</div>
                <h3>Produtos</h3>
                <p>Consultar, criar e editar produtos</p>
            </a>
            <a href="index.php?action=categorias" class="dashboard-card">
                <div class="dashboard-icone">🏷️</div>
                <h3>Categorias</h3>
                <p>Organizar produtos por categoria</p>
            </a>
            <a href="index.php?action=localizacoes" class="dashboard-card">
                <div class="dashboard-icone">📍</div>
                <h3>Localizações</h3>
                <p>Gerir armazéns e prateleiras</p>
            </a>
            <a href="index.php?action=unidades" class="dashboard-card">
                <div class="dashboard-icone">📐</div>
                <h3>Unidades</h3>
                <p>Unidades de medida do stock</p>
            </a>
            <a href="index.php?action=movimentos" class="dashboard-card">
                <div class="dashboard-icone">🔄</div>
                <h3>Movimentos</h3>
                <p>Histórico de entradas e saídas</p>
            </a>
            <?php if ($ehAdmin): ?>
            <a href="index.php?action=utilizadores" class="dashboard-card">
                <div class="dashboard-icone">👤</div>
                <h3>Utilizadores</h3>
                <p>Gerir contas e perfis de acesso</p>
            </a>
            <?php endif; ?>
            <a href="index.php?action=relatorios" class="dashboard-card">
                <div class="dashboard-icone">📊</div>
                <h3>Relatórios</h3>
                <p>Estatísticas e relatórios do sistema</p>
            </a>
        </div>
    </main>
</body>
</html>