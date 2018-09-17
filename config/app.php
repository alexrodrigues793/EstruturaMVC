<?php
/**
 * Inicia a sessão
 */
session_start();

/**
 * Configura a hora local
 */
date_default_timezone_set('America/Sao_Paulo');

/**
 * Define os cabeçalhos de requisição
 * para poder criar uma API com retorno de JSON
 *
 * Para utilizar descomente as linhas abaixo
 */
// header("Access-Control-Allow-Origin: http://localhost");
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Allow-Methods: GET, POST, PUT, PATH, DELETE, OPTIONS");
// header("Access-Control-Allow-Headers: X-Requested-With");
// header("Content-Type: application/json; charset=utf-8");

/** 
 * Reporta todos os errors e Exceções
 */
error_reporting(E_ALL);

/**
 * Define o path da aplicação
 */
define("ROOT_PATH", __DIR__."/../");

/** 
 * Define o caminho das views para o template
 * engine Blade
 */
define("VIEWS_PATH", ROOT_PATH."views/");

/**
 * Define o caminho da pasta de cache para
 * o template engine Blade
 */
define("VIEWS_CACHE_PATH", ROOT_PATH."storage/Blade/cache/");

/**
 * Inclui o arquivo que contem as funções globais
 */
include "functions.php";
