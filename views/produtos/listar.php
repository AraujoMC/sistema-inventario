<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
// A variável $produtos vem do controller (array de produtos vindos do BD)
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
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
        <h1>Produtos</h1>

        <a href="index.php?action=produto-novo" class="btn-novo">+ Novo Produto</a>

        <form action="index.php" method="GET" class="form-pesquisa">
            <input type="hidden" name="action" value="produtos">
            <input type="text" name="pesquisa" placeholder="Pesquisar por nome ou código..."
                   value="<?= htmlspecialchars($_GET['pesquisa'] ?? '') ?>">
            <button type="submit">Pesquisar</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($produtos)): ?>
                    <tr>
                        <td colspan="6">Nenhum produto encontrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><?= htmlspecialchars($produto['codigo']) ?></td>
                            <td><?= htmlspecialchars($produto['nome']) ?></td>
                            <td><?= htmlspecialchars($produto['categoria_nome']) ?></td>
                            <td><?= htmlspecialchars($produto['quantidade']) ?></td>
                            <td><?= htmlspecialchars($produto['preco']) ?></td>
                            <td>
                                <a href="index.php?action=produto-editar&id=<?= urlencode($produto['id']) ?>">Editar</a>
                                <a href="index.php?action=apagar_produto&id=<?= urlencode($produto['id']) ?>"
                                   onclick="return confirm('Tem a certeza que quer apagar este produto?')">Apagar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
