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
        return $stmt->fetchAll(PDO::FETCH_OBJ);
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
}