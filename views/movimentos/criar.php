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
    <title>Novo Movimento</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <span>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="index.php?action=logout">Sair</a>
    </header>

    <main>
        <h1>Novo Movimento de Stock</h1>

        <form action="index.php?action=criar_movimento" method="POST">
            <label for="produto_id">Produto</label>
            <select name="produto_id" id="produto_id" required>
                <option value="">-- Escolha --</option>
                <?php foreach ($produtos as $produto): ?>
                    <option value="<?= htmlspecialchars($produto['id']) ?>">
                        <?= htmlspecialchars($produto['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="tipo">Tipo de Movimento</label>
            <select name="tipo" id="tipo" required>
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
            </select>

            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" min="1" required>

            <label for="motivo">Motivo</label>
            <input type="text" name="motivo" id="motivo" placeholder="Ex: Compra ao fornecedor, venda, ajuste...">

            <label for="data">Data</label>
            <input type="date" name="data" id="data" value="<?= date('Y-m-d') ?>" required>

            <button type="submit">Registar</button>
        </form>

        <a href="index.php?action=movimentos">← Voltar à lista</a>
    </main>
</body>
</html>
