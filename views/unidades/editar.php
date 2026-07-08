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
    <title>Editar Unidade de Medida</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <main>
        <h1>Editar Unidade de Medida</h1>

        <form action="index.php?action=editar_unidade" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($unidade['id']) ?>">

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($unidade['nome']) ?>" required>

            <label for="sigla">Sigla</label>
            <input type="text" name="sigla" id="sigla" value="<?= htmlspecialchars($unidade['sigla']) ?>" required>

            <button type="submit">Actualizar</button>
        </form>

        <a href="index.php?action=unidades">← Voltar à lista</a>
    </main>
</body>
</html>
