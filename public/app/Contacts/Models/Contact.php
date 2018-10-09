<?php

namespace Contacts\Models;

use Contacts\DatabaseConnection;

class Contact
{
    public $id;
    public $name;
    public $phone;

    public $errors = [];

    public function __construct($id, $name, $phone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
    }

    public static function filter($name = null)
    {
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $db = new DatabaseConnection();
        $req = $db->connection->query('SELECT * FROM contacts order by name');
        if ($name !== '') {
            $req = $db->connection->prepare('SELECT * FROM contacts
                where name like ? order by name');
            $req->execute(array("%$name%"));
        }

        $contacts = [];
        foreach($req->fetchAll() as $contact) {
            $contacts[] = new Contact($contact['id'], $contact['name'],
                $contact['phone']);
        }

        return $contacts;
    }

    public static function find($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $db = new DatabaseConnection();
        $req = $db->connection->prepare('SELECT * FROM contacts where id = :id');
        $req->execute(array('id' => $id));
        $contact = $req->fetch();
        return new Contact($contact['id'], $contact['name'], $contact['phone']);
    }

    public function save()
    {
        if (self::validate()){
            if (isset($this->id)) {
                self::update();
            } else {
                self::insert();
            }
            return true;
        }

        return false;
    }

    public function destroy()
    {
        $db = new DatabaseConnection();
        $sql = "DELETE from contacts WHERE id = :id";
        $req = $db->connection->prepare($sql);

        # TODO: filter / sanitize user input
        $req->bindParam(':id', $this->id);
        $req->execute();

        if ((int) $req->errorCode() === 0) {
            return true;
        }
        return false;
    }

    private function validate()
    {
        $name = trim($this->name);
        $phone = trim($this->phone);

        if ($name === "") {
            $this->errors[] = 'Name must be informed';
        }
        if ($phone === "") {
            $this->errors[] = 'Phone must be informed';
        }

        if (! preg_match('/\(\d{2}\)\s*\d{5}-*\d{4}/', $phone)){
            $this->errors[] = 'Phone format is invalid';
        }

        return count($this->errors) === 0;
    }

    private function insert()
    {
        $db = new DatabaseConnection();
        $sql = "INSERT INTO contacts (name, phone, created_at) VALUES
            (:name, :phone, now())";
        $req = $db->connection->prepare($sql);

        # TODO: filter / sanitize user input
        $req->bindParam(':name', $this->name);
        $req->bindParam(':phone', $this->phone);
        $req->execute();

        if ((int) $req->errorCode() === 0) {
            $this->id = $db->connection->lastInsertId();
            return true;
        }
        return false;
    }

    private function update()
    {
        $db = new DatabaseConnection();
        $sql = "UPDATE contacts set name = :name, phone = :phone WHERE
            id = :id";
        $req = $db->connection->prepare($sql);

        # TODO: filter / sanitize user input
        $req->bindParam(':name', $this->name);
        $req->bindParam(':phone', $this->phone);
        $req->bindParam(':id', $this->id);
        $req->execute();

        if ((int) $req->errorCode() === 0) {
            return true;
        }
        return false;
    }

}