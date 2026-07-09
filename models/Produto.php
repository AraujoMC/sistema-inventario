<?php
namespace Models;

require_once __DIR__ . '/../config/Database.php';
use Config\Database;
use PDO;

class Produto {

    // Lista produtos, com filtros opcionais: pesquisa (nome/código), categoria e data de cadastro
    public static function listarTodas($pesquisa = null, $categoriaId = null, $data = null) {
        $db = Database::getConnection();

        $sql = "SELECT p.*, c.nome AS categoria_nome
                FROM produtos p
                LEFT JOIN categorias c ON c.id = p.categoria_id";

        $condicoes = [];
        $params = [];

        if (!empty($pesquisa)) {
            $condicoes[] = "(p.nome LIKE :pesquisa1 OR p.codigo LIKE :pesquisa2)";
            $params[':pesquisa1'] = '%' . $pesquisa . '%';
            $params[':pesquisa2'] = '%' . $pesquisa . '%';
        }

        if (!empty($categoriaId)) {
            $condicoes[] = "p.categoria_id = :categoria_id";
            $params[':categoria_id'] = $categoriaId;
        }

        if (!empty($data)) {
            $condicoes[] = "DATE(p.data_criacao) = :data";
            $params[':data'] = $data;
        }

        if ($condicoes) {
            $sql .= " WHERE " . implode(" AND ", $condicoes);
        }

        $sql .= " ORDER BY p.nome ASC";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id) {
        $db = Database::getConnection();
        $sql = "SELECT * FROM produtos WHERE id = :id LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function criar($nome, $codigo, $categoriaId, $quantidade, $preco, $foto = null) {
        $db = Database::getConnection();
        $sql = "INSERT INTO produtos (nome, codigo, categoria_id, quantidade, preco, foto)
                VALUES (:nome, :codigo, :categoria_id, :quantidade, :preco, :foto)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':codigo' => $codigo,
            ':categoria_id' => $categoriaId,
            ':quantidade' => $quantidade,
            ':preco' => $preco,
            ':foto' => $foto
        ]);
    }

    public static function atualizar($id, $nome, $codigo, $categoriaId, $quantidade, $preco, $foto = null) {
        $db = Database::getConnection();

        if ($foto) {
            $sql = "UPDATE produtos SET nome = :nome, codigo = :codigo, categoria_id = :categoria_id,
                    quantidade = :quantidade, preco = :preco, foto = :foto WHERE id = :id";
        } else {
            $sql = "UPDATE produtos SET nome = :nome, codigo = :codigo, categoria_id = :categoria_id,
                    quantidade = :quantidade, preco = :preco WHERE id = :id";
        }

        $stmt = $db->prepare($sql);
        $params = [
            ':id' => $id,
            ':nome' => $nome,
            ':codigo' => $codigo,
            ':categoria_id' => $categoriaId,
            ':quantidade' => $quantidade,
            ':preco' => $preco
        ];
        if ($foto) {
            $params[':foto'] = $foto;
        }
        return $stmt->execute($params);
    }

    public static function apagar($id) {
        $db = Database::getConnection();
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Ajusta a quantidade em stock (usado pelos movimentos de entrada/saída)
    public static function ajustarQuantidade($id, $delta) {
        $db = Database::getConnection();
        $sql = "UPDATE produtos SET quantidade = quantidade + :delta WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([':id' => $id, ':delta' => $delta]);
    }
}
