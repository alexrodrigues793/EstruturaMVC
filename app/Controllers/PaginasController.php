<?php

namespace App\Controllers;

use App\Controllers\Controller;

class PaginasController extends Controller
{
	public function index()
	{
		return $this->render('site/index.php');
	}

	public function hello()
	{
		return $this->render('site/hello.php', ['name' => $this->request()->getString('name')]);
	}
}
