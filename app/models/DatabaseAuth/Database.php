<?php

namespace app\models\DatabaseAuth;

use PDO;
use Exception;
use PDOException;

class Database
{
    private static $instance;
    private $host;
    private $databaseName;
    private $loginName;
    private $password;
    private $options;
    private $connection;

    public function __construct($host, $databaseName, $loginName, $password)
    {
        $this->host = $host;
        $this->databaseName = $databaseName;
        $this->loginName = $loginName;
        $this->password = $password;
        $this->options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $this->connect();
    }

    public function connect()
    {
        try {
            if (!$this->connection) {
                $this->connection = new PDO(
                    'mysql:host=' . $this->host . ';dbname=' . $this->databaseName . ';charset=utf8',
                    $this->loginName,
                    $this->password,
                    $this->options
                );
            }
        } catch (Exception $e) {
            die('Erreur connexion : ' . $e->getMessage());
        }
        return $this->connection;
    }

    public function prepare($sql)
    {
        try {
            $connection = $this->connect();
            return $connection->prepare($sql);
        } catch (PDOException $e) {
            die('Erreur de préparation de la requête : ' . $e->getMessage());
        }
    }

    public static function getInstance($host, $databaseName, $loginName, $password)
    {
        if (!self::$instance) {
            self::$instance = new self($host, $databaseName, $loginName, $password);
        }
        return self::$instance;
    }
}
