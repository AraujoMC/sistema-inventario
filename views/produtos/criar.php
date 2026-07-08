<?php
session_start();
if (!isset($_SESSION['utilizador_id'])) {
    header('Location: ../login.php');
    exit;
}
// $categorias vem do controller — lista para preencher o <select>
// $erro vem do controller, se a validação falhar (ex: campo vazio)
$erro = $_SESSION['erro_form'] ?? null;
unset($_SESSION['erro_form']);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Novo Produto</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['nome']) ?></span>
        <a href="../../index.php?action=logout">Sair</a>
    </header>

    <main>
        <h1>Novo Produto</h1>

        <?php if ($erro): ?>
            <p class="erro"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form action="../../index.php?action=criar_produto" method="POST" enctype="multipart/form-data">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required>

            <label for="codigo">Código</label>
            <input type="text" name="codigo" id="codigo" required>

            <label for="categoria_id">Categoria</label>
            <select name="categoria_id" id="categoria_id" required>
                <option value="">-- Escolha --</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= htmlspecialchars($categoria['id']) ?>">
                        <?= htmlspecialchars($categoria['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" min="0" required>

            <label for="preco">Preço</label>
            <input type="number" name="preco" id="preco" step="0.01" min="0" required>

            <label for="foto">Foto do produto</label>
            <input type="file" name="foto" id="foto" accept="image/*">

            <button type="submit">Guardar</button>
        </form>

        <a href="listar.php">← Voltar à lista</a>
    </main>
</body>
</html>