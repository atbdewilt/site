<?php

namespace app\Controller;

use app\Core\Controller;

class Index extends Controller
{
    public function index()
    {
        // Render the view
        $this->View->render('index', [
            'title' => 'NS App',
            'text' => 'Deze website zou hetzelfde moeten kunnen als de NS App.'
        ]);
    }
}