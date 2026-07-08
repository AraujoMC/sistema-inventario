<?php
<<<<<<< HEAD
// views/inicio/index.php

=======
>>>>>>> 162372fabb17a2e0d243b4693303507592f8765d
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

<<<<<<< HEAD
// Se já estiver logado, manda direto para o dashboard
if (isset($_SESSION['usuario_id'])) {
    header('Location: ../dashboard/index.php');
    exit;
}
=======
if (!isset($_SESSION['usuario_id'])) {
    header('Location: views/auth/login.php');
    exit;
}

$nomeUsuario   = $_SESSION['usuario_nome'];
$perfilUsuario = $_SESSION['usuario_perfil'];
>>>>>>> 162372fabb17a2e0d243b4693303507592f8765d
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>Sistema de Inventário</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="pagina-inicial">
    <div class="hero">
        <div class="hero-conteudo">
            <span class="hero-badge">Gestão de Inventário</span>
            <h1>Controlo total do teu stock, num só lugar</h1>
            <p>
                Regista produtos, acompanha movimentos de entrada e saída,
                organiza por categorias e localizações, e gera relatórios
                em segundos.
            </p>
            <div class="hero-botoes">
                <a href="../auth/login.php" class="btn-primario">Entrar</a>
                <a href="#funcionalidades" class="btn-secundario">Ver funcionalidades</a>
            </div>
        </div>
    </div>

    <section id="funcionalidades" class="funcionalidades">
        <h2>O que o sistema faz</h2>

        <div class="cards-grid">
            <div class="card-funcionalidade">
                <div class="icone">📦</div>
                <h3>Gestão de Produtos</h3>
                <p>Cria, edita e organiza produtos por categoria, com fotos e códigos únicos.</p>
            </div>

            <div class="card-funcionalidade">
                <div class="icone">🔄</div>
                <h3>Movimentos de Stock</h3>
                <p>Regista entradas e saídas com histórico completo por data.</p>
            </div>

            <div class="card-funcionalidade">
                <div class="icone">📍</div>
                <h3>Localizações</h3>
                <p>Organiza o stock por armazéns, prateleiras ou secções.</p>
            </div>

            <div class="card-funcionalidade">
                <div class="icone">📊</div>
                <h3>Relatórios</h3>
                <p>Consulta relatórios de stock baixo, movimentos mensais e produtos por categoria.</p>
            </div>

            <div class="card-funcionalidade">
                <div class="icone">🔍</div>
                <h3>Pesquisa Rápida</h3>
                <p>Encontra qualquer produto por nome, código, data ou categoria.</p>
            </div>

            <div class="card-funcionalidade">
                <div class="icone">🔐</div>
                <h3>Acesso Seguro</h3>
                <p>Perfis de utilizador distintos, com autenticação protegida.</p>
            </div>
        </div>
    </section>

    <footer class="footer-inicial">
        <p>Sistema de Inventário &copy; 2026 — Projecto Final PW</p>
    </footer>
=======
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
>>>>>>> 162372fabb17a2e0d243b4693303507592f8765d
</body>
</html>
