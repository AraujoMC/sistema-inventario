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
}