<?php
    namespace app\configs;

    use PDO;
    use PDOException;

    class Db {
        private $pdo;

        private $params;

        public function __construct() {
            $this->params = require __DIR__ . '/config.php';
            
            try {
                $this->pdo = new PDO("mysql:host=".$this->params['host'].";dbname=".$this->params['dbname'], $this->params['username'], $this->params['password']);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        public function getConnection() {
            return $this->pdo;
        }
    }