<?php
namespace App\Core;

use App\Core\Request;

/**
 * Classe que configura as rotas e inicia o programa
 */
class Router
{
    private $request;
    private static $getRoutes = array();
    private static $postRoutes = array();
    private static $putRoutes = array();
    private static $pathRoutes = array();
    private static $deleteRoutes = array();

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Método que inicia a aplicação
     */
    public function run()
    {
        // se a requisição for GET
        if ($this->request->getRequestType() == "GET")
        {
            return $this->searchRoute(self::$getRoutes, $this->request->getUrl());
        }

        // se a requisição for POST
        if ($this->request->getRequestType() == "POST")
        {
            return $this->searchRoute(self::$postRoutes, $this->request->getUrl());
        }

        // se a requisição for PUT
        if ($this->request->getRequestType() == "PUT")
        {
            return $this->searchRoute(self::$putRoutes, $this->request->getUrl());
        }

        // se a requisição for PATH
        if ($this->request->getRequestType() == "PATH")
        {
            return $this->searchRoute(self::$pathRoutes, $this->request->getUrl());
        }

        // se a requisição for DELETE
        if ($this->request->getRequestType() == "DELETE")
        {
            return $this->searchRoute(self::$deleteRoutes, $this->request->getUrl());
        }
    }

    /**
     * Método privado que busca uma rota
     */
    private function searchRoute(&$routes, $url)
    {
        foreach ($routes as $route)
        {
            // verifica se a rota é compatível com a url da pagina
            if (preg_match("@^$route[regexRoute]$@", $url))
            {
                // verifica se é uma função chamavel ao invés de controlador
                if (is_callable($route["action"]))
                    return $this->executeCallableFunction($route);
                else
                    return $this->executeController($route);
            }
        }

        // se a rota não foi encontrada executa o controlador de erro
        return $this->executeController(["route" => "error", "controller" => "ErrorController", "action" => "error"]);
    }

    /**
     * Método que executa o controlador e chama a função
     *
     * @param $route Rota e suas informações
     */
    private function executeController($route)
    {
        // configura os parametros passados pela rota
        $this->request->configRouteParameters($route["route"]);

        // configura e instancia o controlador
        $controllerPath = "\App\Controllers\\".$route["controller"];
        $controller = new $controllerPath();

        return call_user_func_array([$controller, $route["action"]], [$this->request]);
    }

    /**
     * Método que executa uma função chamavel ao invés de um controlador
     *
     * @param $route Rota e suas informações
     */
    private function executeCallableFunction($route)
    {
        // configura os parametros passados pela rota
        $this->request->configRouteParameters($route["route"]);

        return call_user_func($route["action"], $this->request);
    }

    /**
     * Insere uma rota GET e suas informações em sua respectiva array
     * 
     * @param string $route Rota
     * @param string $controller Dados do controlador que será chamado
     */
    public static function addGet($route, $controller)
    {
        self::addRoute($route, $controller, self::$getRoutes);
    }

    /**
     * Insere uma rota POST e suas informações em sua respectiva array
     * 
     * @param string $route Rota
     * @param string $controller Dados do controlador que será chamado
     */
    public static function addPost($route, $controller)
    {
        self::addRoute($route, $controller, self::$postRoutes);
    }

    /**
     * Insere uma rota PUT e suas informações em sua respectiva array
     * 
     * @param string $route Rota
     * @param string $controller Dados do controlador que será chamado
     */
    public static function addPut($route, $controller)
    {
        self::addRoute($route, $controller, self::$putRoutes);
    }

    /**
     * Insere uma rota PATH e suas informações em sua respectiva array
     * 
     * @param string $route Rota
     * @param string $controller Dados do controlador que será chamado
     */
    public static function addPath($route, $controller)
    {
        self::addRoute($route, $controller, self::$pathRoutes);
    }

    /**
     * Insere uma rota DELETE e suas informações em sua respectiva array
     * 
     * @param string $route Rota
     * @param string $controller Dados do controlador que será chamado
     */
    public static function addDelete($route, $controller)
    {
        self::addRoute($route, $controller, self::$deleteRoutes);
    }
    
    /**
     * Insere uma rota e suas informações em sua respectiva array
     * 
     * @param string $route Rota
     * @param string $controller Dados do controlador que será chamado
     * @param array &$routes Array passada por referencia de onde se deve salvar a rota
     */
    private static function addRoute($route, $controller, &$routes)
    {
        $route      = trim($route, "/");
        
        // se foi passado uma string com o controller e o método
        // como "HomeController@getIndex"
        if (is_string($controller))
        {
            $controller = explode("@", $controller);

            // salva a rota e seus dados
            array_push($routes, [
                "route" => $route,
                "regexRoute" => self::getRegexRoute($route),
                "controller" => $controller[0],
                "action" => $controller[1]
            ]);
        }
        // se for uma função chamavel como: function($request) {...}
        else
        {
            // salva a rota e seus dados
            array_push($routes, [
                "route" => $route,
                "regexRoute" => self::getRegexRoute($route),
                "action" => $controller
            ]);
        }
    }

    /**
     * Método que recebe uma rota como 'book/{id}', e converte
     * em regex como 'book/(.+)'
     * 
     * @param string $route Rota a ser convertida
     * @return $regexRoute Rota convertida em regex
     */
    private static function getRegexRoute($route)
    {
        // se a rota for vazia retorna vazio
        if ($route == "")
            return "";
        
        // converte a rota em array
        $routeParts = explode("/", $route);
        $regexRoute = "";

        // loop nas partes da rota
        foreach ($routeParts as $part)
        {
            if (strpos($part, "{") === 0) // se vai ser parametro, adiciona os caracteres regex a $routRegex
                $regexRoute .= "(.+)/";
            else
                $regexRoute .= $part."/"; // se não, adiciona a parte normal a $routeRegex
        }

        return trim($regexRoute, "/");
    }
}