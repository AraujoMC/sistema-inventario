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
    <title>Localizações</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['nome']) ?></span>
        <a href="../../index.php?action=logout">Sair</a>
    </header>

    <nav>
        <a href="../dashboard.php">Dashboard</a>
        <a href="../produtos/listar.php">Produtos</a>
        <a href="../categorias/listar.php">Categorias</a>
        <a href="listar.php">Localizações</a>
    </nav>

    <main>
        <h1>Localizações</h1>
        <a href="criar.php" class="btn-novo">+ Nova Localização</a>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($localizacoes)): ?>
                    <tr><td colspan="3">Nenhuma localização encontrada.</td></tr>
                <?php else: ?>
                    <?php foreach ($localizacoes as $localizacao): ?>
                        <tr>
                            <td><?= htmlspecialchars($localizacao['codigo']) ?></td>
                            <td><?= htmlspecialchars($localizacao['nome']) ?></td>
                            <td>
                                <a href="editar.php?id=<?= urlencode($localizacao['id']) ?>">Editar</a>
                                <a href="../../index.php?action=apagar_localizacao&id=<?= urlencode($localizacao['id']) ?>"
                                   onclick="return confirm('Apagar esta localização?')">Apagar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>