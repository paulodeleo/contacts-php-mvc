<?php

namespace Contacts\Views\Contact;

class ContactView
{
    public $template;
    public $contact;
    public $contacts;

    public function __construct($template, $object)
    {
        $this->template = $template;

        if (is_array($object)) {
            $this->contacts = $object;
        } else {
            $this->contact = $object;
        }

        session_start();
    }

    public function addMessage($message)
    {
        $_SESSION['message'] = $message;
    }

    public function render() {
        $contact = $this->contact;
        $contacts = $this->contacts;

        require_once __DIR__ . '/../../Views/Layout/header.php';
        require_once __DIR__ . '/../../Views/Contact/' . $this->template;
        require_once __DIR__ . '/../../Views/Layout/footer.php';
    }

}