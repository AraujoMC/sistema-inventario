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
    <title>Relatório: Produtos Cadastrados</title>
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
        <h1>Relatório: Produtos Cadastrados</h1>
        <p>Total: <?= count($produtos) ?> produto(s)</p>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Data de Cadastro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= htmlspecialchars($produto['codigo']) ?></td>
                        <td><?= htmlspecialchars($produto['nome']) ?></td>
                        <td><?= htmlspecialchars($produto['categoria_nome'] ?? '—') ?></td>
                        <td><?= htmlspecialchars($produto['quantidade']) ?></td>
                        <td><?= number_format((float) $produto['preco'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($produto['data_criacao']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="index.php?action=relatorios">← Voltar aos relatórios</a>
    </main>
</body>
</html>
