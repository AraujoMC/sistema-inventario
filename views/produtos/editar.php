<?php
session_start();
if (!isset($_SESSION['utilizador_id'])) {
    header('Location: ../login.php');
    exit;
}
// $produto vem do controller (os dados do produto específico, encontrado pelo id no URL)
// $categorias vem do controller, igual ao criar.php
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['nome']) ?></span>
        <a href="../../index.php?action=logout">Sair</a>
    </header>

    <main>
        <h1>Editar Produto</h1>

        <form action="../../index.php?action=editar_produto" method="POST" enctype="multipart/form-data">
            <!-- Campo escondido: diz ao controller QUAL produto estamos a editar -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>

            <label for="codigo">Código</label>
            <input type="text" name="codigo" id="codigo" value="<?= htmlspecialchars($produto['codigo']) ?>" required>

            <label for="categoria_id">Categoria</label>
            <select name="categoria_id" id="categoria_id" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= htmlspecialchars($categoria['id']) ?>"
                        <?= ($categoria['id'] == $produto['categoria_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categoria['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" value="<?= htmlspecialchars($produto['quantidade']) ?>" min="0" required>

            <label for="preco">Preço</label>
            <input type="number" name="preco" id="preco" value="<?= htmlspecialchars($produto['preco']) ?>" step="0.01" min="0" required>

            <label for="foto">Nova foto (opcional)</label>
            <input type="file" name="foto" id="foto" accept="image/*">

            <button type="submit">Actualizar</button>
        </form>

        <a href="listar.php">← Voltar à lista</a>
    </main>
</body>
</html>