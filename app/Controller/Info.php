<?php

namespace app\Controller;

use app\Core\Controller;

class Info extends Controller
{
    public function index()
    {
        // Render the view
        $this->View->render('info', [
            'title' => 'Informatie',
            'text' => 'Hieronder staat de omschrijving van de opdracht.'
        ]);
    }
}