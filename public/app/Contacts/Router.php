<?php
namespace Contacts;

use Contacts\Controllers\ContactController;

class Router
{
    public $controller;
    public $action;
    public $id;

    public function __construct($url)
    {
        $url_parts = explode('/', $url);

        $this->controller = $url_parts[1] ?? null;
        $this->action = explode('?', $url_parts[2])[0] ?? null;
        $this->id = $url_parts[3] ?? null;
    }

    public function callControllerAction()
    {
        if ($this->controller === 'contacts') {
            $controller = new ContactController();
        }
        $controller->{$this->action}($this->id);
    }

    public static function redirectTo($relative_path) {
        header("location:$relative_path");
    }
}