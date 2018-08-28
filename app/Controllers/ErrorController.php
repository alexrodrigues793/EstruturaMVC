<?php
namespace App\Controllers;

/**
 * Controlador que exibe uma página de erro
 */
class ErrorController
{
    public function error($request)
    {
        view('404');
    }
}