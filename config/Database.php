<?php
namespace Config;

use PDO;
use PDOException;

class Database {
    private static $instancia = null;

    public static function getConnection() {
        if (self::$instancia === null) {
            $host = 'localhost';
            $dbname = 'inventario_db';
            $username = 'root';
            $password = '';

            try{
                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

                $opcoes = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];

                self::$instancia = new PDO($dsn, $username, $password, $opcoes);
            }   catch (PDOException $e) {
                die("Erro na conexão com a base de dados: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}