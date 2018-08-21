<?php

// ***********************************************************************************
// Classe que armazena todas as requisições
// ***********************************************************************************

namespace App\Core;

class Request
{
	private $uri;
	public $params;
	
	public function __construct()
	{
		// configura a url
		$this->uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),'/');
		// configura os parametros
		$this->params = new FilteredMap(array_merge($_POST, $_GET));
	}
	
	// Retorna a url acessada
	public function getUri(): string
	{
		return $this->uri;
	}

	// Método que adiciona os os parametros passados pela url a array de parametros
	public function configUrlParams(string $route)
	{
		if ($route == '') return [];
		
		$routePart = explode('/', trim($route, '/'));
		$uriPart = explode('/', $this->getUri());
		$urlParams = [];
		
		foreach ($routePart as $key => $param) {
			if (strpos($param, '{') == 0) {
				$param = str_replace('{', '', $param);
				$param = str_replace('}', '', $param);
				$urlParams[trim($param)] = urldecode($uriPart[$key]);
			}
		}
		
		$this->params->addParams($urlParams);
	}
}
