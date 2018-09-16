<?php
namespace App\Controllers;

use App\Models\Contacts;

class HomeController
{
    public function getIndex($request)
    {
        return view('welcome');
    }
}
