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
    <title>Editar Utilizador</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <main>
        <h1>Editar Utilizador</h1>

        <form action="index.php?action=editar_utilizador" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($utilizador['id']) ?>">

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($utilizador['nome']) ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($utilizador['email']) ?>" required>

            <label for="senha">Nova senha (deixa vazio para manter a actual)</label>
            <input type="password" name="senha" id="senha" minlength="6">

            <label for="perfil_id">Perfil</label>
            <select name="perfil_id" id="perfil_id" required>
                <?php foreach ($perfis as $perfil): ?>
                    <option value="<?= htmlspecialchars($perfil['id']) ?>"
                        <?= ($perfil['id'] == $utilizador['perfil_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($perfil['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Actualizar</button>
        </form>

        <a href="index.php?action=utilizadores">← Voltar à lista</a>
    </main>
</body>
</html>