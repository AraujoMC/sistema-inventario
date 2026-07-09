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
    <title>Relatório: Stock Baixo</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <nav>
        <a href="index.php?action=dashboard">Dashboard</a>
        <a href="index.php?action=relatorios">Relatórios</a>
    </nav>

    <main>
        <h1>Relatório: Produtos com Stock Baixo</h1>
        <p>Total: <?= count($produtos) ?> produto(s) abaixo ou no limite mínimo</p>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Quantidade Actual</th>
                    <th>Quantidade Mínima</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($produtos)): ?>
                    <tr><td colspan="5">Nenhum produto com stock baixo. ✅</td></tr>
                <?php else: ?>
                    <?php foreach ($produtos as $produto): ?>
                        <tr class="alerta">
                            <td><?= htmlspecialchars($produto['codigo']) ?></td>
                            <td><?= htmlspecialchars($produto['nome']) ?></td>
                            <td><?= htmlspecialchars($produto['categoria_nome'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($produto['quantidade']) ?></td>
                            <td><?= htmlspecialchars($produto['quantidade_minima']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="index.php?action=relatorios">← Voltar aos relatórios</a>
    </main>
</body>
</html>
