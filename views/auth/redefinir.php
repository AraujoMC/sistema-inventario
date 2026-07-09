<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$msg = $_SESSION['msg_login'] ?? null;
unset($_SESSION['msg_login']);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <main>
        <h1>Redefinir Senha</h1>

        <?php if ($msg): ?>
            <p><?= htmlspecialchars($msg) ?></p>
        <?php endif; ?>

        <form action="../../index.php?action=redefinir-senha" method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <label for="nova_senha">Nova senha</label>
            <input type="password" name="nova_senha" id="nova_senha" minlength="6" required>

            <button type="submit">Guardar nova senha</button>
        </form>

        <a href="login.php">← Voltar ao login</a>
    </main>
</body>
</html>
