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
 * Define o tipo de resposta da aplicação como 'application/json',
 * para pode criar uma API
 *
 * Para utilizar descomente a linha abaixo
 */
// header("Content-Type: application/json");

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
