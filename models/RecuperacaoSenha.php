<?php
namespace Models;

require_once __DIR__ . '/../config/Database.php';
use Config\Database;
use PDO;

class RecuperacaoSenha {

    public static function criar($utilizadorId, $token) {
        $db = Database::getConnection();
        $sql = "INSERT INTO recuperacoes_senha (utilizador_id, token) VALUES (:utilizador_id, :token)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([':utilizador_id' => $utilizadorId, ':token' => $token]);
    }

    public static function buscarPorToken($token) {
        $db = Database::getConnection();
        $sql = "SELECT * FROM recuperacoes_senha WHERE token = :token AND usado = 0 LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function marcarUsado($id) {
        $db = Database::getConnection();
        $sql = "UPDATE recuperacoes_senha SET usado = 1 WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
