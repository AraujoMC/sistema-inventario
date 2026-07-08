<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Utilizadores</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <nav>
        <a href="index.php?action=dashboard">Dashboard</a>
        <a href="index.php?action=utilizadores">Utilizadores</a>
    </nav>

    <main>
        <h1>Utilizadores</h1>
        <a href="index.php?action=utilizador-novo" class="btn-novo">+ Novo Utilizador</a>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($utilizadores)): ?>
                    <tr><td colspan="4">Nenhum utilizador encontrado.</td></tr>
                <?php else: ?>
                    <?php foreach ($utilizadores as $utilizador): ?>
                        <tr>
                            <td><?= htmlspecialchars($utilizador['nome']) ?></td>
                            <td><?= htmlspecialchars($utilizador['email']) ?></td>
                            <td><?= htmlspecialchars($utilizador['perfil_nome']) ?></td>
                            <td>
                                <a href="index.php?action=utilizador-editar&id=<?= urlencode($utilizador['id']) ?>">Editar</a>
                                <a href="index.php?action=apagar_utilizador&id=<?= urlencode($utilizador['id']) ?>"
                                   onclick="return confirm('Apagar este utilizador?')">Apagar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>