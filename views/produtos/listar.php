<?php
session_start();
if (!isset($_SESSION['utilizador_id'])) {
    header('Location: ../login.php');
    exit;
}
// A variável $produtos vem do controller (array de produtos vindos do BD)
// Ela deve chegar já pronta a este ficheiro quando o controller faz include/require desta view
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['nome']) ?></span>
        <a href="../../index.php?action=logout">Sair</a>
    </header>

    <nav>
        <a href="../dashboard.php">Dashboard</a>
        <a href="listar.php">Produtos</a>
    </nav>

    <main>
        <h1>Produtos</h1>

        <a href="criar.php" class="btn-novo">+ Novo Produto</a>

        <!-- Formulário de pesquisa (Bloco 4, mas fica bem aqui) -->
        <form action="listar.php" method="GET" class="form-pesquisa">
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
                                <a href="editar.php?id=<?= urlencode($produto['id']) ?>">Editar</a>
                                <a href="../../index.php?action=apagar_produto&id=<?= urlencode($produto['id']) ?>"
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