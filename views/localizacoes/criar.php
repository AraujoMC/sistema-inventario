<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario_id'])) {
   header('Location: views/auth/login.php');   // ✅ correcto
    exit;
}
$erro = $_SESSION['erro_form'] ?? null;
unset($_SESSION['erro_form']);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Nova Localização</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <main>
        <h1>Nova Localização</h1>

        <?php if ($erro): ?>
            <p class="erro"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form action="index.php?action=nova-localizacao" method="POST">
            <label for="codigo">Código</label>
            <input type="text" name="codigo" id="codigo" required>

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required>

            <button type="submit">Guardar</button>
        </form>

        <a href="index.php?action=localizacoes">← Voltar à lista</a>
    </main>
</body>
</html>
