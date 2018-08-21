<?php
require_once "../vendor/autoload.php";
require_once "../setup/app.php";

use App\Core\Request;
use App\Core\Router;

// functions
require_once "../setup/functions.php";

// Router
$app = new Router(new Request());

// routes
require_once "../setup/routes.php";

// start app
echo $app->run();
