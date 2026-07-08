<?php
session_start();
if (!isset($_SESSION['utilizador_id'])) {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Utilizadores</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['nome']) ?></span>
        <a href="../../index.php?action=logout">Sair</a>
    </header>

    <nav>
        <a href="../dashboard.php">Dashboard</a>
        <a href="listar.php">Utilizadores</a>
    </nav>

    <main>
        <h1>Utilizadores</h1>
        <a href="criar.php" class="btn-novo">+ Novo Utilizador</a>

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
                                <a href="editar.php?id=<?= urlencode($utilizador['id']) ?>">Editar</a>
                                <a href="../../index.php?action=apagar_utilizador&id=<?= urlencode($utilizador['id']) ?>"
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