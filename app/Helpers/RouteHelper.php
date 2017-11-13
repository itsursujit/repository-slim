<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/7/17
 * Time: 5:07 PM
 */

namespace App\Helpers;


use App\Exceptions\Exception;
use Auryn\Injector;
use FastRoute\RouteCollector;
use Http\Request;
use Http\Response;

class RouteHelper
{
    public static function run(\FastRoute\Dispatcher $dispatcher, Request $request, Response $response, Injector $injector) {
        $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                $response->setContent('404 - Page not found');
                $response->setStatusCode(404);
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $response->setContent('405 - Method not allowed');
                $response->setStatusCode(405);
                break;
            case \FastRoute\Dispatcher::FOUND:
                $className = $routeInfo[1][0];
                $method = $routeInfo[1][1];
                $vars = $routeInfo[2];

                $class = $injector->make($className);
                $class->$method($vars);
                break;
        }
    }

    static function addRoutes($webRoutes, $apiRoutes) {
        $routeDefinitionCallback = function (RouteCollector $r) use($webRoutes, $apiRoutes) {

            foreach ($webRoutes as $route) {
                if(is_array($route[2])) {
                    throw new Exception('Invalid Route Controller. Define the Controller Route properly');
                }
                $controllerHandler = explode('@', $route[2]);
                if(!isset($controllerHandler[1])) {
                    throw new Exception('Invalid Route Controller');
                }
                $controllerHandler[0] = 'App\Controllers\\' . $controllerHandler[0];
                $route[2] = $controllerHandler;
                $r->addRoute($route[0], $route[1], $route[2]);
            }

            $r->addGroup('/api', function (RouteCollector $r) use($apiRoutes) {
                foreach ($apiRoutes as $route) {
                    if(is_array($route[2])) {
                        throw new Exception('Invalid Route Controller. Define the Controller Route properly');
                    }
                    $controllerHandler = explode('@', $route[2]);
                    if(!isset($controllerHandler[1])) {
                        throw new Exception('Invalid Route Controller');
                    }
                    $controllerHandler[0] = 'App\Controllers\\' . $controllerHandler[0];
                    $route[2] = $controllerHandler;
                    $r->addRoute($route[0], $route[1], $route[2]);
                }
            });
        };
        return $routeDefinitionCallback;
    }
}