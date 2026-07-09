<?php
namespace Controllers;

require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../models/Categoria.php';
require_once __DIR__ . '/../services/CambioApi.php';
use Models\Produto;
use Models\Categoria;
use Services\CambioApi;

class ProdutoController {

    private function protegerRota() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: views/auth/login.php');
            exit;
        }
    }

    // Faz o upload da foto e devolve o caminho relativo guardado na BD, ou null
    private function processarUpload() {
        if (empty($_FILES['foto']['name'])) {
            return null;
        }

        $permitidos = ['image/jpeg', 'image/png', 'image/webp'];
        $tipo = mime_content_type($_FILES['foto']['tmp_name']);

        if (!in_array($tipo, $permitidos)) {
            return null; // tipo de ficheiro não permitido, ignora o upload
        }

        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nomeFicheiro = uniqid('produto_') . '.' . $extensao;
        $destino = __DIR__ . '/../assets/uploads/' . $nomeFicheiro;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
            return 'assets/uploads/' . $nomeFicheiro;
        }
        return null;
    }

    public function index() {
        $this->protegerRota();
        $pesquisa = $_GET['pesquisa'] ?? null;
        $produtos = Produto::listarTodas($pesquisa);
        $taxaUsd = CambioApi::obterTaxaUsd();
        require_once __DIR__ . '/../views/produtos/listar.php';
    }

    public function novo() {
        $this->protegerRota();
        $categorias = Categoria::listarTodas();
        require_once __DIR__ . '/../views/produtos/criar.php';
    }

    public function armazenar() {
        $this->protegerRota();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoriaId = filter_input(INPUT_POST, 'categoria_id', FILTER_VALIDATE_INT);
            $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
            $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);

            if (!empty($nome) && !empty($codigo) && $quantidade !== false && $preco !== false) {
                $foto = $this->processarUpload();
                Produto::criar($nome, $codigo, $categoriaId, $quantidade, $preco, $foto);
            }
            header('Location: index.php?action=produtos');
            exit;
        }
    }

    public function editar() {
        $this->protegerRota();
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php?action=produtos'); exit; }

        $produto = Produto::buscarPorId($id);
        if (!$produto) { header('Location: index.php?action=produtos'); exit; }

        $categorias = Categoria::listarTodas();
        require_once __DIR__ . '/../views/produtos/editar.php';
    }

    public function atualizar() {
        $this->protegerRota();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoriaId = filter_input(INPUT_POST, 'categoria_id', FILTER_VALIDATE_INT);
            $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
            $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);

            if ($id && !empty($nome) && !empty($codigo)) {
                $foto = $this->processarUpload();
                Produto::atualizar($id, $nome, $codigo, $categoriaId, $quantidade, $preco, $foto);
            }
            header('Location: index.php?action=produtos');
            exit;
        }
    }

    public function apagar() {
        $this->protegerRota();
        $id = $_GET['id'] ?? null;
        if ($id) {
            Produto::apagar($id);
        }
        header('Location: index.php?action=produtos');
        exit;
    }
}
