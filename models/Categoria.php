<?php
namespace Models;

require_once __DIR__ . '/../config/Database.php';
use Config\Database;
use PDO;

class Categoria {

    public static function listarTodas() {
        $db = Database::getConnection();
        $sql = "SELECT * FROM categorias ORDER BY nome ASC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id) {
        $db = Database::getConnection();
        $sql = "SELECT * FROM categorias WHERE id = :id LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function criar($nome, $descricao) {
        $db = Database::getConnection();
        $sql = "INSERT INTO categorias (nome, descricao) VALUES (:nome, :descricao)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao
        ]);
    }

    public static function atualizar($id, $nome, $descricao) {
        $db = Database::getConnection();
        $sql = "UPDATE categorias SET nome = :nome, descricao = :descricao WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':descricao' => $descricao
        ]);
    }

    public static function apagar($id) {
        $db = Database::getConnection();
        $sql = "DELETE FROM categorias WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
