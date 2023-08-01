<?php

namespace App\Model;
use PDO;
class ConectDB
{
    private static $instance = null;
    private $conn;
    private $host = 'localhost';
    private $nameDB = 'crm-for-telegram';
    private $user = 'root';
    private $password = 'mysql';

    public function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host}; dbname={$this->nameDB};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->conn = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            die('Ошибка подключения к базе данных: ' . $e->getMessage());
        }
    }
    // возврат сам объект класса 'Database'
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // метод, который возвращает объект подключения к БД
    public function getConnection()
    {
        return $this->conn;
    }
}


