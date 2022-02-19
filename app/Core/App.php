<?php

namespace app\Core;

class App
{
    private $controller = DEFAULT_CONTROLLER;
    private $method = DEFAULT_CONTROLLER_METHOD;
    private $params = [];

    public function __construct()
    {
        $this->parseURL();

        $this->getController();
        $this->getMethod();
        $this->getParams();
    }

    private function getController()
    {
        // Check if something is in the first section of the URL
        if (isset($this->params[1]) && !empty($this->params[1])) {
            // Check if there is a controller by that name
            if (file_exists(CONTROLLER_PATH . $this->params[1] . '.php')) {
                $this->controller = ucfirst(strtolower($this->params[1]));
                unset($this->params[1]);
            } else {
                die('404');
            }
        }

        // Add the namespace to the controller
        $namespace = 'app\\Controller\\';

        // Instantiate the controller
        $this->controller = new ($namespace . $this->controller);
    }

    private function getMethod()
    {
        // Check if something is in the second section of the URL
        if (isset($this->params[2]) && !empty($this->params[2])) {
            // Check if there is a method by that name in the chosen controller
            if (is_callable([$this->controller, $this->params[2]])) {
                $this->method = $this->params[2];
                unset($this->params[2]);
            } else {
                die('404');
            }
        }
    }

    private function getParams()
    {
        // Reassign array keys because of the unset values
        $this->params = array_values($this->params);
    }

    private function parseURL()
    {
        // Sanitize URL and turn it in an array
        $this->params = explode('/', filter_var(rtrim(substr($_SERVER['REQUEST_URI'], 1)), FILTER_SANITIZE_URL));

        // Unset the first param because it's a subfolder
        unset($this->params[0]);
    }

    public function run()
    {
        // Call the chosen method in the controller and pass the left over params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
}