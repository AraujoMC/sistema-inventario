<?php
namespace Models;

require_once __DIR__ . '/../config/Database.php';
use Config\Database;
use PDO;

class Relatorio {

    public static function produtosCadastrados() {
        $db = Database::getConnection();
        $sql = "SELECT p.id, p.nome, p.codigo, c.nome AS categoria_nome, p.quantidade, p.preco, p.data_criacao
                FROM produtos p
                LEFT JOIN categorias c ON c.id = p.categoria_id
                ORDER BY p.data_criacao DESC";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function stockBaixo() {
        $db = Database::getConnection();
        $sql = "SELECT p.id, p.nome, p.codigo, c.nome AS categoria_nome, p.quantidade, p.quantidade_minima
                FROM produtos p
                LEFT JOIN categorias c ON c.id = p.categoria_id
                WHERE p.quantidade <= p.quantidade_minima
                ORDER BY p.quantidade ASC";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function movimentacoesPorMes() {
        $db = Database::getConnection();
        $sql = "SELECT DATE_FORMAT(data, '%Y-%m') AS mes,
                       tipo,
                       COUNT(*) AS total_movimentos,
                       SUM(quantidade) AS total_quantidade
                FROM movimentos_stock
                GROUP BY mes, tipo
                ORDER BY mes DESC, tipo ASC";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function totais() {
        $db = Database::getConnection();
        $totais = [];
        $totais['produtos'] = (int) $db->query("SELECT COUNT(*) FROM produtos")->fetchColumn();
        $totais['utilizadores'] = (int) $db->query("SELECT COUNT(*) FROM utilizadores")->fetchColumn();
        $totais['categorias'] = (int) $db->query("SELECT COUNT(*) FROM categorias")->fetchColumn();
        $totais['stock_baixo'] = (int) $db->query("SELECT COUNT(*) FROM produtos WHERE quantidade <= quantidade_minima")->fetchColumn();
        return $totais;
    }
}
