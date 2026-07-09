<?php
// Esta parte vem no topo — mostra erro se o backend mandou um
session_start();
$erro = $_SESSION['erro_login'] ?? null;
$msg = $_SESSION['msg_login'] ?? null;
unset($_SESSION['erro_login'], $_SESSION['msg_login']);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema de Inventário</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Iniciar Sessão</h1>

        <?php if ($erro): ?>
            <p class="erro"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <?php if ($msg): ?>
            <p class="sucesso"><?= htmlspecialchars($msg) ?></p>
        <?php endif; ?>

        <form action="../../index.php?action=login" method="POST" id="formLogin">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit">Entrar</button>
        </form>

        <a href="recuperar.php">Esqueci a senha</a>
    </div>

<script src="../../assets/js/validacao.js"></script>
</body>
</html>