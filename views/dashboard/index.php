<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Segurança: se não estiver logado, manda para o login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$nomeUsuario   = $_SESSION['usuario_nome'];
$perfilUsuario = $_SESSION['usuario_perfil'];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistema de Inventário</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
   <main>
        <div class="dashboard-boas-vindas">
            <h1>Sistema de Gestão de Inventário</h1>
            <p>Escolhe uma opção abaixo para começar.</p>
        </div>

        <div class="dashboard-grid">
            <a href="../../index.php?action=produtos" class="dashboard-card">
                <div class="dashboard-icone">📦</div>
                <h3>Produtos</h3>
                <p>Consultar, criar e editar produtos</p>
            </a>

            <a href="../../index.php?action=categorias" class="dashboard-card">
                <div class="dashboard-icone">🏷️</div>
                <h3>Categorias</h3>
                <p>Organizar produtos por categoria</p>
            </a>

            <a href="../../index.php?action=localizacoes" class="dashboard-card">
                <div class="dashboard-icone">📍</div>
                <h3>Localizações</h3>
                <p>Gerir armazéns e prateleiras</p>
            </a>

            <a href="../../index.php?action=unidades" class="dashboard-card">
                <div class="dashboard-icone">📐</div>
                <h3>Unidades</h3>
                <p>Unidades de medida do stock</p>
            </a>

            <a href="../../index.php?action=movimentos" class="dashboard-card">
                <div class="dashboard-icone">🔄</div>
                <h3>Movimentos</h3>
                <p>Histórico de entradas e saídas</p>
            </a>

            <a href="../../index.php?action=utilizadores" class="dashboard-card">
                <div class="dashboard-icone">👤</div>
                <h3>Utilizadores</h3>
                <p>Gerir contas e perfis de acesso</p>
            </a>
        </div>
    </main>
</body>
</html>