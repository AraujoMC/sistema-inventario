<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
$msg = $_SESSION['msg_perfil'] ?? null;
$erro = $_SESSION['erro_perfil'] ?? null;
unset($_SESSION['msg_perfil'], $_SESSION['erro_perfil']);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <nav>
        <a href="index.php?action=dashboard">Dashboard</a>
        <a href="index.php?action=meu-perfil">Meu Perfil</a>
    </nav>

    <main>
        <h1>Meu Perfil</h1>

        <?php if ($msg): ?>
            <p class="sucesso"><?= htmlspecialchars($msg) ?></p>
        <?php endif; ?>
        <?php if ($erro): ?>
            <p class="erro"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <h2>Dados pessoais</h2>
        <form action="index.php?action=atualizar-perfil" method="POST">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($utilizador['nome']) ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($utilizador['email']) ?>" required>

            <button type="submit">Guardar dados</button>
        </form>

        <h2>Alterar senha</h2>
        <form action="index.php?action=alterar-senha" method="POST">
            <label for="senha_atual">Senha actual</label>
            <input type="password" name="senha_atual" id="senha_atual" required>

            <label for="nova_senha">Nova senha</label>
            <input type="password" name="nova_senha" id="nova_senha" minlength="6" required>

            <button type="submit">Alterar senha</button>
        </form>

        <a href="index.php?action=dashboard">← Voltar ao dashboard</a>
    </main>
</body>
</html>
