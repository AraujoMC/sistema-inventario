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
    <title>Movimentos de Stock</title>
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
        <a href="listar.php">Movimentos</a>
    </nav>

    <main>
        <h1>Movimentos de Stock</h1>
        <a href="criar.php" class="btn-novo">+ Novo Movimento</a>

        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Tipo</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($movimentos)): ?>
                    <tr><td colspan="4">Nenhum movimento registado.</td></tr>
                <?php else: ?>
                    <?php foreach ($movimentos as $movimento): ?>
                        <tr>
                            <td><?= htmlspecialchars($movimento['produto_nome']) ?></td>
                            <td><?= htmlspecialchars(ucfirst($movimento['tipo'])) ?></td>
                            <td><?= htmlspecialchars($movimento['quantidade']) ?></td>
                            <td><?= htmlspecialchars($movimento['data']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>