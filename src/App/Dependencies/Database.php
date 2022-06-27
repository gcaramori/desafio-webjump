<?php
    namespace Dependencies;

    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    class Database {
        protected $conn;
        private $dbHost;
        private $dbName;
        private $dbUser;
        private $dbPass;

        public function connect() {
            $this->conn = null;
            $this->dbHost = $_ENV['DB_HOST'];
            $this->dbName = $_ENV['DB_NAME'];
            $this->dbUser = $_ENV['DB_USER'];
            $this->dbPass = $_ENV['DB_PASS'];

            try {
                $this->conn = new \PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPass);
                $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $exception) {
                $this->conn = "Database could not be connected: " . $exception->getMessage();
            }

            return $this->conn;
        }
    }
?>