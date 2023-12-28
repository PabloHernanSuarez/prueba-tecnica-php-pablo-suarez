<?php

namespace App\Drivers;

use PDO;
use PDOException;
use App\Kernel\Response;

trait MysqlDriver
{
    protected string $host;
    protected string $database;
    protected string $user;
    protected string $password;
    protected string $port;
    protected $conn;

    public function __construct()
    {
        $drivers = include __DIR__."/../Config/database.php";
        $this->host = $drivers['mysql']['host'];
        $this->database = $drivers['mysql']['database'];
        $this->user = $drivers['mysql']['user'];
        $this->password = $drivers['mysql']['password'];
        $this->port = $drivers['mysql']['port'];
    }

    protected function connect()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            Response::httpResponse(503, "No es posible conectarse a la base de datos");
            die();
        }
    }

    protected function disconnect()
    {
        $this->conn = null;
    }
}

