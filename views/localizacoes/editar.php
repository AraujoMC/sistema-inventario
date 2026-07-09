<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario_id'])) {
    header('Location: views/auth/login.php');   // ✅ correcto
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Localização</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <main>
        <h1>Editar Localização</h1>

        <form action="index.php?action=editar_localizacao" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($localizacao['id']) ?>">

            <label for="codigo">Código</label>
            <input type="text" name="codigo" id="codigo" value="<?= htmlspecialchars($localizacao['codigo']) ?>" required>

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($localizacao['nome']) ?>" required>

            <button type="submit">Actualizar</button>
        </form>

        <a href="index.php?action=localizacoes">← Voltar à lista</a>
    </main>
</body>
</html>
