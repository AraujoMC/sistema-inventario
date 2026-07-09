<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$msg = $_SESSION['msg_recuperacao'] ?? null;
$tokenSimulado = $_SESSION['token_simulado'] ?? null;
unset($_SESSION['msg_recuperacao'], $_SESSION['token_simulado']);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <main>
        <h1>Recuperar Senha</h1>

        <?php if ($msg): ?>
            <p class="sucesso"><?= htmlspecialchars($msg) ?></p>
        <?php endif; ?>

        <?php if ($tokenSimulado): ?>
            <!-- Simulação: em produção isto seria enviado por email, não mostrado no ecrã -->
            <p>Link de recuperação (simulado):</p>
            <p>
                <a href="../../index.php?action=redefinir-senha&token=<?= urlencode($tokenSimulado) ?>">
                    Clica aqui para redefinir a tua senha
                </a>
            </p>
        <?php else: ?>
            <form action="../../index.php?action=recuperar-senha" method="POST">
                <label for="email">O teu email</label>
                <input type="email" name="email" id="email" required>
                <button type="submit">Enviar link de recuperação</button>
            </form>
        <?php endif; ?>

        <a href="login.php">← Voltar ao login</a>
    </main>
</body>
</html>
