<?php
// inicia a seção
session_start();

// set root path
define("ROOT_PATH", __DIR__."/../");

// set views path for blade
define("VIEWS_PATH", ROOT_PATH."views/");

// set views cache path for blade
define("VIEWS_CACHE_PATH", ROOT_PATH."storage/Blade/cache/");

// Reporta todos os errors Exceçẽs
error_reporting(E_ALL);

// Define a hora local
date_default_timezone_set('America/Sao_Paulo');

// include functions
include "functions.php";