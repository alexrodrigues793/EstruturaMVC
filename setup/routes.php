<?php
use App\Core\Router;

// add routes
Router::addRoute('', 'PaginasController@index');
Router::addRoute('hello/{name}', 'PaginasController@hello');

Router::addRoute('login', 'UsuarioController@login');
Router::addRoute('registrar', 'UsuarioController@registrar');
Router::addRoute('sair', 'UsuarioController@sair');
