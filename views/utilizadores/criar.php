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
    <title>Novo Utilizador</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <main>
        <h1>Novo Utilizador</h1>

        <form action="index.php?action=criar_utilizador" method="POST">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required minlength="6">

            <label for="perfil_id">Perfil</label>
            <select name="perfil_id" id="perfil_id" required>
                <?php foreach ($perfis as $perfil): ?>
                    <option value="<?= htmlspecialchars($perfil['id']) ?>">
                        <?= htmlspecialchars($perfil['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Guardar</button>
        </form>

        <a href="index.php?action=utilizadores">← Voltar à lista</a>
    </main>
</body>
</html>
