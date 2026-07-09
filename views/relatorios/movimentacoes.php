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
    <title>Relatório: Movimentações por Mês</title>
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
        <h1>Relatório: Movimentações por Mês</h1>

        <table>
            <thead>
                <tr>
                    <th>Mês</th>
                    <th>Tipo</th>
                    <th>Nº de Movimentos</th>
                    <th>Quantidade Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($linhas)): ?>
                    <tr><td colspan="4">Nenhuma movimentação registada.</td></tr>
                <?php else: ?>
                    <?php foreach ($linhas as $linha): ?>
                        <tr>
                            <td><?= htmlspecialchars($linha['mes']) ?></td>
                            <td><?= htmlspecialchars(ucfirst($linha['tipo'])) ?></td>
                            <td><?= htmlspecialchars($linha['total_movimentos']) ?></td>
                            <td><?= htmlspecialchars($linha['total_quantidade']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="index.php?action=relatorios">← Voltar aos relatórios</a>
    </main>
</body>
</html>
