<?php
namespace Models;

require_once __DIR__ . '/../config/Database.php';
use Config\Database;
use PDO;

class User {

    public static function buscarPorEmail($email) {
        $db = Database::getConnection();
        $sql = "SELECT * FROM utilizadores WHERE email = :email AND ativo = 1 LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Lista todos os utilizadores, com o nome do perfil incluído (JOIN)
    public static function listarTodos() {
        $db = Database::getConnection();
        $sql = "SELECT u.*, p.nome AS perfil_nome
                FROM utilizadores u
                JOIN perfis p ON p.id = u.perfil_id
                WHERE u.ativo = 1
                ORDER BY u.nome";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id) {
        $db = Database::getConnection();
        $sql = "SELECT * FROM utilizadores WHERE id = :id LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // A senha já deve chegar aqui encriptada com password_hash() (feito no controller)
    public static function criar($nome, $email, $senhaHash, $perfilId) {
        $db = Database::getConnection();
        $sql = "INSERT INTO utilizadores (nome, email, senha, perfil_id) VALUES (:nome, :email, :senha, :perfil_id)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senhaHash,
            ':perfil_id' => $perfilId
        ]);
    }

    // Se $senhaHash vier vazio, a senha actual não é alterada
    public static function atualizar($id, $nome, $email, $perfilId, $senhaHash = null) {
        $db = Database::getConnection();

        if ($senhaHash) {
            $sql = "UPDATE utilizadores SET nome = :nome, email = :email, perfil_id = :perfil_id, senha = :senha WHERE id = :id";
        } else {
            $sql = "UPDATE utilizadores SET nome = :nome, email = :email, perfil_id = :perfil_id WHERE id = :id";
        }

        $stmt = $db->prepare($sql);
        $params = [
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email,
            ':perfil_id' => $perfilId
        ];
        if ($senhaHash) {
            $params[':senha'] = $senhaHash;
        }
        return $stmt->execute($params);
    }

    public static function apagar($id) {
        $db = Database::getConnection();
        $sql = "DELETE FROM utilizadores WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Usado pela recuperação de senha: altera só a senha, nada mais
    public static function atualizarSenha($id, $senhaHash) {
        $db = Database::getConnection();
        $sql = "UPDATE utilizadores SET senha = :senha WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([':id' => $id, ':senha' => $senhaHash]);
    }
}
