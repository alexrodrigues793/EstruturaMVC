<?php

// ***********************************************************************************
// Classe principal que faz a aplicação funcionar
// ***********************************************************************************

namespace App\Core;

class Router
{
	private $request;
	private static $routes = [];
	
	public function __construct(Request $request)
	{
		$this->request = $request;
	}
	
	// Método que executa a aplicação
	public function run() {
		// realiza um loop nas rotas
		foreach (self::$routes as $route) {
			// verifica se existe alguma rota compatível com a url acessada
			if (preg_match("@^$route[regexRoute]$@", $this->request->getUri())) {
				// se existir executa o controlador correspondente
				return $this->executeController($this->request, $route);
			}
		}
		
		// se a url acessada não for compatível com nenhuma rota, executa o controlador de erro
		$errorController = new \App\Controllers\ErrorController($this->request);
		return $errorController->notFound();
	}
	
	// Método que adiciona uma rota na aplicação
	public static function addRoute(string $route, string $routeInfo) {
		$routeInfoPart = explode('@', $routeInfo);
		array_push(self::$routes, [
			'route' => $route,
			'regexRoute' => self::getRegexRoute($route),
			'controller' => $routeInfoPart[0],
			'action' => $routeInfoPart[1]
		]);
	}
	
	// Método que retorna uma rota em formato de expressão regular
	private static function getRegexRoute(string $route) {
		// se a rota for vazia retorna vazia
		if ($route == '') return '';
		
		// converte a rota em array
		$routePart = explode('/', $route);
		$regexRoute = '';
		foreach ($routePart as $part) {
			// verifica se existe o caractere '{' que indica uma informação passada pelo usuario na url
			if (strpos($part, '{') === 0) {
				// substitui a parte indicada pela expressão '(.+)'
				$regexRoute .= '/(.+)';
			} else {
				$regexRoute .= $part;
			}
		}
		
		return trim($regexRoute, '/');
	}
	
	// Método que executa o controlador
	private function executeController(Request $request, array $routeInfo) {
		// adiciona as informações passadas via url na classe Request
		$request->configUrlParams($routeInfo['route']);

		// configura e instância o controlador
		$controllerPath = '\App\Controllers\\' . $routeInfo['controller'];
		$controller = new $controllerPath($request);
		
		return call_user_func([$controller, $routeInfo['action']]);
	}
}
