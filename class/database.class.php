<?php

/**
 * Description of Database
 *
 * @author jmartinez
 */
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try{
            $this->pdo = new PDO('mysql:localhost=localhost;dbname=tasktimer', 'root', '');
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public static function getInstance() {
            if(!isset(self::$instance)) {
                self::$instance = new Database();
            }
            return self::$instance->pdo;
        }
}


