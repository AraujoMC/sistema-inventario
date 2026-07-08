<?php
namespace Models;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Produto.php';
use Config\Database;
use PDO;
use PDOException;

class Movimento {

    // Lista todos os movimentos, com o nome do produto incluído (JOIN)
    public static function listarTodos() {
        $db = Database::getConnection();
        $sql = "SELECT m.*, p.nome AS produto_nome
                FROM movimentos_stock m
                JOIN produtos p ON p.id = m.produto_id
                ORDER BY m.data DESC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Regista o movimento E actualiza a quantidade do produto, tudo numa transação:
    // se uma das duas operações falhar, a outra também é desfeita (integridade).
    public static function registar($produtoId, $utilizadorId, $tipo, $quantidade, $motivo, $data) {
        $db = Database::getConnection();

        try {
            $db->beginTransaction();

            $sql = "INSERT INTO movimentos_stock (produto_id, utilizador_id, tipo, quantidade, motivo, data)
                    VALUES (:produto_id, :utilizador_id, :tipo, :quantidade, :motivo, :data)";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':produto_id' => $produtoId,
                ':utilizador_id' => $utilizadorId,
                ':tipo' => $tipo,
                ':quantidade' => $quantidade,
                ':motivo' => $motivo,
                ':data' => $data
            ]);

            $delta = ($tipo === 'entrada') ? $quantidade : -$quantidade;
            Produto::ajustarQuantidade($produtoId, $delta);

            $db->commit();
            return true;
        } catch (PDOException $e) {
            $db->rollBack();
            return false;
        }
    }
}
