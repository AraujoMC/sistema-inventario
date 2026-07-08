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
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function criar($nome, $descricao) {
        $db = Database::getConnection();
        $sql = "INSERT INTO localizacoes (nome, descricao) VALUES (:nome, :descricao)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao
        ]);
    }
}