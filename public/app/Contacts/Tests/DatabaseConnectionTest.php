<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Contacts\DatabaseConnection;

class DatabaseConnectionTest extends \PHPUnit\Framework\TestCase
{

    public function setUp(){ }
    public function tearDown(){ }

    public function testConnectionIsValid()
    {
        $db = new DatabaseConnection();
        $req = $db->connection->query('SELECT * FROM contacts order by name');
        $this->assertTrue(count($req->fetchAll()) > 0);
    }

}