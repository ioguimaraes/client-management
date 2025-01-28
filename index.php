<?php
/**
 * @Author Igor de Oliveira Guimarães
 * @copyright 2025
 **/

require_once("vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createMutable(__DIR__);
$dotenv->load();

require_once("Core/router.php");
require_once("Core/settings.php");
error_reporting(!APPLICATION_DEBUG ?? E_ALL);

//INIT SESSION MANAGER
session_start();

$_GET_URI = explode("/", $_SERVER['REQUEST_URI']);
$_CONTROLLER_NAME = strtoupper($_GET_URI[2]);

if( isset($core_routes[$_CONTROLLER_NAME]) ) {

    if( empty($_SESSION) &&  $_CONTROLLER_NAME != 'LOGIN' ){
        header("Location:" . APPLICATION_NAME . "/login/home");
        die;
    }

    require_once("Core/Controller.core.php");
    require_once("Core/Model.core.php");
    
    require_once $core_routes[$_CONTROLLER_NAME]['Controller'];
    require_once $core_routes[$_CONTROLLER_NAME]['Model'];

    $controller = new $core_routes[$_CONTROLLER_NAME]['Name']($core_routes);

    if( method_exists($controller, @$_GET_URI[3]) ) {
        $controller->{$_GET_URI[3]}();
    } else {
        header("Location:" . APPLICATION_NAME . "/login/home");
        die;
    }

} else {
    header("Location:" . APPLICATION_NAME . "/login/home");
    die;
}