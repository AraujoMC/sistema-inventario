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
    <title>Unidades de Medida</title>
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
        <a href="index.php?action=categorias">Categorias</a>
        <a href="index.php?action=localizacoes">Localizações</a>
        <a href="index.php?action=unidades">Unidades</a>
    </nav>

    <main>
        <h1>Unidades de Medida</h1>
        <a href="index.php?action=unidade-nova" class="btn-novo">+ Nova Unidade</a>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sigla</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($unidades)): ?>
                    <tr><td colspan="3">Nenhuma unidade encontrada.</td></tr>
                <?php else: ?>
                    <?php foreach ($unidades as $unidade): ?>
                        <tr>
                            <td><?= htmlspecialchars($unidade['nome']) ?></td>
                            <td><?= htmlspecialchars($unidade['sigla']) ?></td>
                            <td>
                                <a href="index.php?action=unidade-editar&id=<?= urlencode($unidade['id']) ?>">Editar</a>
                                <a href="index.php?action=apagar_unidade&id=<?= urlencode($unidade['id']) ?>"
                                   onclick="return confirm('Apagar esta unidade?')">Apagar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
