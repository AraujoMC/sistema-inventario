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
    <title>Categorias</title>
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
        <a href="listar.php">Categorias</a>
    </nav>

    <main>
        <h1>Categorias</h1>
        <a href="criar.php" class="btn-novo">+ Nova Categoria</a>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($categorias)): ?>
                    <tr><td colspan="3">Nenhuma categoria encontrada.</td></tr>
                <?php else: ?>
                    <?php foreach ($categorias as $categoria): ?>
                        <tr>
                            <td><?= htmlspecialchars($categoria['nome']) ?></td>
                            <td><?= htmlspecialchars($categoria['descricao']) ?></td>
                            <td>
                                <a href="editar.php?id=<?= urlencode($categoria['id']) ?>">Editar</a>
                                <a href="../../index.php?action=apagar_categoria&id=<?= urlencode($categoria['id']) ?>"
                                   onclick="return confirm('Apagar esta categoria?')">Apagar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>