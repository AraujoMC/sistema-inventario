<label for="nome">Nome</label>
<input type="text" name="nome" id="nome" required>

<label for="email">Email</label>
<input type="email" name="email" id="email" required>

<label for="senha">Senha</label>
<input type="password" name="senha" id="senha" required minlength="6">

<label for="perfil_id">Perfil</label>
<select name="perfil_id" id="perfil_id" required>
    <?php foreach ($perfis as $perfil): ?>
        <option value="<?= htmlspecialchars($perfil['id']) ?>">
            <?= htmlspecialchars($perfil['nome']) ?>
        </option>
    <?php endforeach; ?>
</select>