<?php
namespace Models;

require_once __DIR__ . '/../config/Database.php';
use Config\Database;
use PDO;

class Categoria {

    // Lista todas as categorias cadastradas
    public static function listarTodas() {
        $db = Database::getConnection();
        $sql = "SELECT * FROM categorias ORDER BY nome ASC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Cria uma nova categoria no negócio
    public static function criar($nome, $descricao) {
        $db = Database::getConnection();
        $sql = "INSERT INTO categorias (nome, descricao) VALUES (:nome, :descricao)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao
        ]);
    }
}