<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/13/17
 * Time: 1:52 PM
 */

namespace App\Middlewares;


use Slim\Http\Request;
use Slim\Http\Response;

class AuthMiddleware
{
    public function __invoke(Request $request, Response $response, $next) {
        $response = $next($request, $response);
        return $response;
    }
}