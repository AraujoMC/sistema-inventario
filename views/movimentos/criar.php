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

    <label for="data">Data</label>
    <input type="date" name="data" id="data" required>

    <button type="submit">Registar</button>
</form>