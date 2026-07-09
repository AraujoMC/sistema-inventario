<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); 
}
if (!isset($_SESSION['usuario_id'])) {
    header('Location: views/auth/login.php');   // ✅ correcto
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Movimentos de Stock</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <nav>
        <a href="index.php?action=dashboard">Dashboard</a>
        <a href="index.php?action=produtos">Produtos</a>
        <a href="index.php?action=movimentos">Movimentos</a>
    </nav>

    <main>
        <h1>Movimentos de Stock</h1>
        <a href="index.php?action=movimento-novo" class="btn-novo">+ Novo Movimento</a>

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