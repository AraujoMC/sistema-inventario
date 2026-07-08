<?php
// views/inicio/index.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se já estiver logado, manda direto para o dashboard
if (isset($_SESSION['usuario_id'])) {
    header('Location: ../dashboard/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
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
</body>
</html>