<?php
namespace Models;

require_once __DIR__ . '/../config/Database.php';
use Config\Database;
use PDO;

class Localizacao {

    public static function listarTodas() {
        $db = Database::getConnection();
        $sql = "SELECT * FROM localizacoes ORDER BY nome ASC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id) {
        $db = Database::getConnection();
        $sql = "SELECT * FROM localizacoes WHERE id = :id LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function criar($codigo, $nome) {
        $db = Database::getConnection();
        $sql = "INSERT INTO localizacoes (codigo, nome) VALUES (:codigo, :nome)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':codigo' => $codigo,
            ':nome' => $nome
        ]);
    }

    public static function atualizar($id, $codigo, $nome) {
        $db = Database::getConnection();
        $sql = "UPDATE localizacoes SET codigo = :codigo, nome = :nome WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':codigo' => $codigo,
            ':nome' => $nome
        ]);
    }

    public static function apagar($id) {
        $db = Database::getConnection();
        $sql = "DELETE FROM localizacoes WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
