<?php
namespace App\Controllers;

use App\Models\Contacts;

class HomeController
{
    public function getIndex($request)
    {
        //var_dump(Contacts::getAll());
        view('welcome', ['title' => 'Estrutura MVC']);
    }
}