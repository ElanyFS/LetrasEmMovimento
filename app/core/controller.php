<?php

function controller($matchedUri)
{
    [$controller, $method] = explode('@', array_values($matchedUri)[0]);

    $controllerWithNamespace = CONTROLLER_PATH . $controller;

    //Verifica se o controller existe
    if (!class_exists($controllerWithNamespace)) {
        throw new Exception("Controller {$controller} não existe");
    }

    $controllerInstance = new $controllerWithNamespace;

    //Verifica se o metodo existe dentro da classe
    if(!method_exists($controllerWithNamespace, $method)){
        throw new Exception("O metódo {$method} não existe no controller {$controller}");
    }

    $controller = $controllerInstance->$method();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        die();
    }

    return $controller;
}
