<?php
session_start();
if (!isset($_SESSION['utilizador_id'])) {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoria</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['nome']) ?></span>
        <a href="../../index.php?action=logout">Sair</a>
    </header>

    <main>
        <h1>Editar Categoria</h1>

        <form action="../../index.php?action=editar_categoria" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($categoria['id']) ?>">

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required>

            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" value="<?= htmlspecialchars($categoria['descricao']) ?>">

            <button type="submit">Actualizar</button>
        </form>

        <a href="listar.php">← Voltar à lista</a>
    </main>
</body>
</html>