<?php

namespace AddressApi;

use AddressApi\Controller\ApiController;

class Router
{
    public static function handleRoute()
    {
        $routes = include PROJECT_ROOT . DIRECTORY_SEPARATOR . 'routes.php';

        foreach ($routes as $route) {
            if (strtoupper($_SERVER['REQUEST_METHOD']) === $route['method']
                && preg_match($route['url'], $_GET['url'])
            ) {
                $controller = new ApiController();
                $action = $route['action'] . 'Action';
                if (method_exists($controller, $action)) {
                    call_user_func([$controller, $action]);
                }

                return;
            }
        }

        http_response_code(404);
    }
} 
