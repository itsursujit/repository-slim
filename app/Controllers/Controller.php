<?php
/**
 * Created by PhpStorm.
 * User: sujitbaniya
 * Date: 11/12/17
 * Time: 10:45 PM
 */

namespace App\Controllers;


use App\Helpers\ResponseHelper;
use App\Services\CourseServiceFactory;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\HttpCache\CacheProvider;
use Slim\Views\Twig;

class Controller {
    private $courseService;
	public function __construct() {
	    $this->courseService = CourseServiceFactory::create();
	}

	public function get(Request $request, Response $response, Twig $view, CacheProvider $cache)
	{
        //$response = $cache->withEtag($response, 'abc');
        $result = $this->courseService->getAllCourses();
        ResponseHelper::toJson(json_encode($result));
		$view->render($response, 'home.twig', ["data" => $request->getAttribute('route')->getArguments()]);
	}
}