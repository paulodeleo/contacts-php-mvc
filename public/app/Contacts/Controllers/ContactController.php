<?php
namespace Contacts\Controllers;

use Contacts\Router;
use Contacts\Models\Contact;
use Contacts\Views\Contact\ContactView;

class ContactController
{
    public function index()
    {
        $contacts = Contact::filter($_GET['filter']);
        $view = new ContactView('index.php', $contacts);
        $view->render();
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        $view = new ContactView('show.php', $contact);
        $view->render();
    }

    public function new()
    {
        $contact = new Contact(null, null, null);
        $view = new ContactView('new.php', $contact);
        $view->render();
    }

    public function create()
    {
        $contact = new Contact(null, $_POST['name'], $_POST['phone']);

        if ($contact->save()) {
            $view = new ContactView('new.php', $contact);
            $view->addMessage("Contact $contact->name created!");
            Router::redirectTo("/contacts/show/$contact->id");
        } else {
            $view = new ContactView('new.php', $contact);
            $view->addMessage("Error creating contact!");
            $view->render();
        }
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        $view = new ContactView('edit.php', $contact);
        $view->render();
    }

    public function update()
    {
        $contact = Contact::find($_POST['id']);
        $contact->id = $_POST['id'];
        $contact->name = $_POST['name'];
        $contact->phone = $_POST['phone'];

        if ($contact->save()) {
            $view = new ContactView('edit.php', $contact);
            $view->addMessage("Contact $contact->name updated!");
            Router::redirectTo("/contacts/show/$contact->id");
        } else {
            $view = new ContactView('edit.php', $contact);
            $view->addMessage("Error updating contact!");
            $view->render();
        }
    }

    public function destroy()
    {
        $contact = Contact::find($_POST['id']);
        if ($contact->destroy()){
            $view = new ContactView('index.php', $contact);
            $view->addMessage("Contact $contact->name deleted!");
            Router::redirectTo("/contacts/index");
        } else {
            $view = new ContactView('show.php', $contact);
            $view->addMessage('Error deleting contact!');
            $view->render();
        }

    }

    private function renderLayoutFor($view_path)
    {
        global $contacts;
        self::renderPageHeader();
        require_once $view_path;
        self::renderPageFooter();
    }

    private function renderPageHeader()
    {
        require_once __DIR__ . '/../Views/Layout/header.php';
    }

    private function renderPageFooter()
    {
        require_once __DIR__ . '/../Views/Layout/footer.php';
    }
}
