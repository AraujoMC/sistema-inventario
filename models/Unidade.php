<?php
namespace Models;

require_once __DIR__ . '/../config/Database.php';
use Config\Database;
use PDO;

class Unidade {

    public static function listarTodas() {
        $db = Database::getConnection();
        $sql = "SELECT * FROM unidades_medida ORDER BY nome ASC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id) {
        $db = Database::getConnection();
        $sql = "SELECT * FROM unidades_medida WHERE id = :id LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function criar($nome, $sigla) {
        $db = Database::getConnection();
        $sql = "INSERT INTO unidades_medida (nome, sigla) VALUES (:nome, :sigla)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':sigla' => $sigla
        ]);
    }

    public static function atualizar($id, $nome, $sigla) {
        $db = Database::getConnection();
        $sql = "UPDATE unidades_medida SET nome = :nome, sigla = :sigla WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':sigla' => $sigla
        ]);
    }

    public static function apagar($id) {
        $db = Database::getConnection();
        $sql = "DELETE FROM unidades_medida WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
