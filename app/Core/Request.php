<?php
namespace App\Core;

use App\Core\File;

/**
 * Class que trata os parametros e urls
 */
class Request
{
    private $url;
    private $parameters;

    public function __construct()
    {
        // configura a url atual exemplo: 'book/all'
        $this->url = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');

        // configura todos os parametros GET e POST
        $this->parameters = array_merge($_POST, $_GET);
    }

    /**
     * Retorna a url atual
     * 
     * @return $this->url
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Retorna o tipo de requisição que está sendo feita
     * 
     * @return string Tipo de requisição
     */
    public function getRequestType(): string
    {
        if (!isset($_POST["REQUEST_METHOD"]))
            return $_SERVER["REQUEST_METHOD"];
        
        if (isset($_POST["REQUEST_METHOD"]) && strtoupper($_POST["REQUEST_METHOD"]) == "PUT")
            return "PUT";
        
        if (isset($_POST["REQUEST_METHOD"]) && strtoupper($_POST["REQUEST_METHOD"]) == "PATH")
            return "PATH";
        
        if (isset($_POST["REQUEST_METHOD"]) && strtoupper($_POST["REQUEST_METHOD"]) == "DELETE")
            return "DELETE";
    }

    /**
     * Retorna um parametro GET ou POST
     * 
     * @param mixed $parameter Nome do paramentro
     * @return $this->paramenters[$parameter]
     */
    public function getParameter($parameter): string
    {
        return isset($this->parameters[$parameter]) ? urldecode($this->parameters[$parameter]) : "";
    }

    /**
     * Método que configura todos os parametros definidos nas rotas
     * e passados pela url como: 'book/{id}' para 'book/10' entao
     * adiciona o 'id' com valor '10' no array de parametros
     * 
     * @param string $route Rota a se extrair os parametros
     */
    public function configRouteParameters(string $route)
    {
        // transforma a rota e a url em array
        $routeParts = explode("/", $route);
        $urlParts   = explode("/", $this->getUrl());

        foreach ($routeParts as $key => $part)
        {
            // verifica se a parte da rota é um parametro
            if (strpos($part, "{") === 0)
            {
                // remove as chaves do nome do parametro
                $part = str_replace("{", "", $part);
                $part = str_replace("}", "", $part);

                // adiciona o parametro e seu valor a array de parametros
                $this->parameters[$part] = $urlParts[$key];
            }
        }
    }


    /**
     * Método que retorna um objeto FILE
     */
    public function getFile($name)
    {
        if (isset($_FILES[$name]))
            return new File($_FILES[$name]);
        else
            return null;
    }
}
