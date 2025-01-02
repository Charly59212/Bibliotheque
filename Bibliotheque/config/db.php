<?php

class Db {
    // Private property constants
    private const DBNAME = "bibliotheque";
    private const SERVER_NAME = "localhost";
    private const USERNAME = "root";
    private const PASSWORD = "";

    // Connection private variable
    private $connection;

    // Constructor
    public function __construct() {
        $this->connect();
    }

    // Connection function
    private function connect() {
        try {
            $this->connection = new PDO("mysql:host=" . self::SERVER_NAME . ";dbname=" . self::DBNAME,
                                self::USERNAME, self::PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->query('SET NAMES utf8');
        } catch (PDOException $exception) {
            die("Erreur de connexion : " . $exception->getMessage());
        }
    }

    // Public method to recover connection
    public function getConnection(): PDO {
        return $this->connection;
    }

}

?>