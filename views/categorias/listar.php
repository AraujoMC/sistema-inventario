<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario_id'])) {
    header('Location: views/auth/login.php');   // ✅ correcto
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Categorias</title>
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
        <h1>Categorias</h1>
        <a href="index.php?action=categoria-nova" class="btn-novo">+ Nova Categoria</a>

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
                                <a href="index.php?action=categoria-editar&id=<?= urlencode($categoria['id']) ?>">Editar</a>
                                <a href="index.php?action=apagar_categoria&id=<?= urlencode($categoria['id']) ?>"
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
