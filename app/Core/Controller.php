<?php

namespace app\Core;

abstract class Controller
{
    protected $View = null;

    public function __construct()
    {
        session_start();

        $this->View = new View;
        $this->View->addCSS('/site/bootstrap/css/bootstrap.css');
    }

    public abstract function index();
}