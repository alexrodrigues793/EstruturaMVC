<?php
require_once "../vendor/autoload.php";
require_once "../config/app.php";

use App\Core\Request;
use App\Core\Router;

// cria um objeto da aplicação
$app = new Router(new Request());

// adiciona as rotas
require_once "../config/routes.php";

// inicia a aplicação
$app->run();