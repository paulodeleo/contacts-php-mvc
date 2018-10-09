<?php

namespace Contacts;

class DatabaseConnection
{
    private $host;
    private $dbname;
    private $user;
    private $password;
    public $connection;

    public function __construct()
    {
        $this->host = getenv('DATABASE_HOST');
        $this->dbname = getenv('DATABASE_NAME');
        $this->user = getenv('DATABASE_USER');
        $this->password = getenv('DATABASE_PASSWORD');

        $this->connection = new \PDO('mysql:host=' . $this->host . ';dbname=' .
            $this->dbname, $this->user, $this->password);

        return $this->connection;
    }

}