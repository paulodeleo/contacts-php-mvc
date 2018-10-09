<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Contacts\DatabaseConnection;
use Contacts\Models\Contact;

class ContactTest extends \PHPUnit\Framework\TestCase
{

    public function setUp()
    {
        $db = new DatabaseConnection();
        $sql = "INSERT INTO `contacts` (`id`, `name`, `phone`, `created_at`)
            VALUES
            (997, 'Test name 1', '(11) 11111-1111',  '2018-10-08 20:46:22'),
            (998, 'Test name 2', '(22) 22222-2222', '2018-10-08 20:47:22'),
            (999, 'Test 3',  '(33) 33333-3333',  '2018-10-08 20:48:40')";
        $req = $db->connection->prepare($sql);
        $req->execute();
    }

    public function tearDown()
    {
        $db = new DatabaseConnection();
        $sql = "DELETE from contacts WHERE name like '%Test%'";
        $req = $db->connection->prepare($sql);
        $req->execute();
    }

    public function testRequiredAttributesValidation()
    {
        $contact = new Contact(null, '', '');
        $this->assertFalse($contact->save());
        $this->assertContains($contact->errors[0], 'Name must be informed');
        $this->assertContains($contact->errors[1], 'Phone must be informed');
    }

    public function testPhoneFormatValidation()
    {
        $contact = new Contact(null, 'Test', 'xxxxxxx');
        $this->assertFalse($contact->save());
        $this->assertContains($contact->errors[0], 'Phone format is invalid');
    }

    public function testCreate()
    {
        $contact = new Contact(null, 'Test', '(41) 99999-9999');
        $contact->save();
        $this->assertTrue($contact->id !== null);
    }

    public function testUpdate()
    {
        $contact = Contact::find(999);
        $contact->name = 'Test 3 updated';
        $contact->save();

        $contact = Contact::find(999);
        $this->assertTrue($contact->name === 'Test 3 updated');
    }

    public function testDestroy()
    {
        $contact = Contact::find(999);
        $contact->destroy();

        $contact = Contact::find(999);
        $this->assertTrue($contact->id === null);
    }
    public function testFilter()
    {
        $contacts = Contact::filter('name');
        $this->assertTrue(count($contacts) === 2);
    }

    public function testFindById()
    {
        $contact = Contact::find(999);
        $this->assertTrue((int) $contact->id === 999);
    }

}