<?php
/**
 * gerar_senha.php
 * ---------------
 * Script auxiliar para gerar um hash de senha compatível com password_verify().
 *
 * COMO USAR:
 * 1. Corre este ficheiro no browser (ex: http://localhost/sistema-inventario/gerar_senha.php)
 *    ou no terminal:  php gerar_senha.php
 * 2. Copia o hash gerado (começa por $2y$...)
 * 3. Cola esse hash na coluna "senha" da tabela utilizadores no phpMyAdmin
 *    (Editar registo -> campo senha -> colar o hash -> Guardar)
 */
 
// ALTERA AQUI a senha que queres usar para entrar no sistema:
$senhaEmTextoPuro = "lesly123";
 
$hash = password_hash($senhaEmTextoPuro, PASSWORD_DEFAULT);
 
echo "Senha original: " . $senhaEmTextoPuro . "\n";
echo "Hash a colar na base de dados:\n";
echo $hash . "\n";
 
// Verificação de confiança: confirma que o hash gerado é válido
if (password_verify($senhaEmTextoPuro, $hash)) {
    echo "\n[OK] O hash foi validado com sucesso com password_verify().\n";
} else {
    echo "\n[ERRO] Algo correu mal ao gerar o hash.\n";
}
 