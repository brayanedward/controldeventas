<?php
$controller = 'dashboard';
//si no recibe controlador, accedera a un controlador por defecto
if (!isset($_REQUEST['c'])) {
    //llama al controlador
    require_once "./controller/controller_" . $controller . ".php";
    //convierte el primer valor del controlador en mayuscula
    $controller = ucwords($controller) . 'Controller';
    //instancia el controlador
    $controller = new $controller;
    //llama el metodo que necesitamos
    $controller->index();
} else {
    // convertimos la variable del controlador a minuscula
    $controller = strtolower($_REQUEST['c']);
    //recibimos la accion
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index';
    // llamamos al controlador
    require_once "./controller/controller_" . $controller . ".php";
    //convertimos la primera letra del controlador en mayuscula
    $controller = ucwords($controller) . 'Controller';
    //instanciamos el controlador
    $controller = new $controller;
    // Llama la accion
    call_user_func(array($controller, $accion));
}
