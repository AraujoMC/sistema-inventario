<?php
namespace Models;

require_once __DIR__ . '/../config/Database.php';
use Config\Database;
use PDO;

class Perfil {
    public static function listarTodos() {
        $db = Database::getConnection();
        $sql = "SELECT * FROM perfis ORDER BY id ASC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
