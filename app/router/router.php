<?php

function existsRouter($uri, $routes)
{
    return array_key_exists($uri, $routes) ? 
    [$uri => $routes[$uri]] : 
    [];

}

function router()
{
    //BUSCA A URI EXATA 
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $routes = require 'routes.php';

    $requestMethod = $_SERVER['REQUEST_METHOD'];

    $matchedUri = existsRouter($uri, $routes[$requestMethod]);

    if(!empty($matchedUri)){
        return controller($matchedUri);
    }

    throw new Exception('Algo deu errado');
}
