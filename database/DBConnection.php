<?php

namespace Database;
use PDO;

class DBConnection
{

    private $dbname;
    private $host;
    private $username;
    private $password;
    private $pdo;

    public function __construct()
    {
              $this->dbname = "blog_db";
              $this->host = "127.0.0.1";
              $this->username = "root";
              $this->password = "";
    }

    public function getPDO(): PDO
    {
        // instancier une nouvelle con si pas null en faisant un opérateur ternaire
        return $this->pdo ?? $this->pdo = new PDO("mysql:dbname={$this->dbname};host={$this->host}", $this->username, $this->password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Permet de recup les elements de la db avec des objects ($post->title) au lieu d'un array ($post['title'])
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            // Pour éviter les problèmes d'encodage
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
        ]);

    }


}
