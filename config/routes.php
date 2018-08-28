<?php
use App\Core\Router;

// Adicione suas rotas aqui
Router::addGet("/", "HomeController@getIndex");