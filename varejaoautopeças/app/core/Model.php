<?php

namespace app\core;

use PDO;
use PDOException;


class Model {

    protected $db;

    public function __construct() {
        
        $dbHost = DB_HOST;
        $dbName = DB_NAME;
        $dbUser = DB_USER;
        $dbPass = DB_PASS;
        $dbCharset = 'utf8mb4';

        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=$dbCharset";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            
            $this->db = new PDO($dsn, $dbUser, $dbPass, $options);
        } catch (PDOException $e) {
            
            
            error_log("Erro de conexão com o banco de dados: " . $e->getMessage());
            
            
            die('Erro ao conectar com o banco de dados. Verifique os logs.');
        }
    }

    
    

}

?>
