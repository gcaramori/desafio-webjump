<?php
    namespace App\Dependencies;

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    interface DBConnectionInterface {
        public function connect();
    }

    class MySQLConnection implements DBConnectionInterface {
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
                $this->conn = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPass);
            }
            catch(PDOException $exception) {
                $this->conn = "Database could not be connected: " . $exception->getMessage();
            }

            return $this->conn;
        }
    }

    class getConnection {
        private $dbConnection;

        public function __construct(DBConnectionInterface $dbConnection) {
            $this->dbConnection = $dbConnection;
        }
    }
?>