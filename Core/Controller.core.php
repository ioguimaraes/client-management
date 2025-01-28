<?php

interface IAppCore
{
    public function home();
}

abstract class Controller implements IAppCore
{

    public $_ROUTES;

    public function __construct($routes)
    {
        $this->_ROUTES = $routes;
    }

    protected function contentType($type)
    {
        switch ($type):
            case 'html':
                header('Content-Type: text/html; charset=UTF-8');
                break;
            case 'clean':
                header('Content-Type: text/html; charset=UTF-8');
                break;
            case 'json':
                header('Content-Type: application/json');
                break;
            case 'ajax':
                header('Content-Type: application/json');

                define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

                if(!IS_AJAX) {
                    header("Location: {APPLICATION_NAME}/login/home/?redir=" . $_SERVER['REQUEST_URI']);
                    die;
                }

                break;
            default:
                header("Content-Type: text/plain");
                break;
        endswitch;
    }

}