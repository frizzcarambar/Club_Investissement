<?php
class Database {

    private const DBHOST = "localhost";
    private const DBUSER = "root";
    private const DBPASS = "root";
    private const DBNAME = "club_investissement";
    private $db;

    function __construct() {
        $dsn = "mysql:dbname=".self::DBNAME.";host=".self::DBHOST.";charset=utf8";
        try {
            $this->db = new PDO($dsn, self::DBUSER, self::DBPASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getDb(){
      return $this->db;
    }
}
