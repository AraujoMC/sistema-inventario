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
    <title>Nova Unidade de Medida</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <main>
        <h1>Nova Unidade de Medida</h1>

        <form action="index.php?action=nova-unidade" method="POST">
            <label for="nome">Nome (ex: Quilograma)</label>
            <input type="text" name="nome" id="nome" required>

            <label for="sigla">Sigla (ex: kg)</label>
            <input type="text" name="sigla" id="sigla" required>

            <button type="submit">Guardar</button>
        </form>

        <a href="index.php?action=unidades">← Voltar à lista</a>
    </main>
</body>
</html>
