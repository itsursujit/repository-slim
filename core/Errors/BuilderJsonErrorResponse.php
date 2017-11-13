<?php
/**
 * Created by PhpStorm.
 * User: sujitbaniya
 * Date: 11/13/17
 * Time: 8:40 PM
 */

namespace Main\Errors;


use DI\Container;
use Main\Errors\Handlers\ErrorHandler;
use Main\Errors\Handlers\NotAllowed;
use Main\Errors\Handlers\NotFound;
use Slim\Views\Twig;

class BuilderJsonErrorResponse
{
	/**
	 * Json PhpError
	 *
	 * @return \Closure
	 */
	public static function jsonPhpError()
	{
		return function (Container $container) {
			return new ErrorHandler($container->get(Twig::class), $container->get('settings')['displayErrorDetails']);
		};
	}

	/**
	 * Json Error
	 *
	 * @return \Closure
	 */
	public static function jsonError()
	{
		return function (Container $container) {
			return new ErrorHandler($container->get(Twig::class), $container->get('settings')['displayErrorDetails']);
		};
	}

	/**
	 * Json NotFound
	 *
	 * @return \Closure
	 */
	public static function jsonNotFound()
	{
		return function (Container $container) {
			return new NotFound($container->get('settings')['displayErrorDetails']);
		};
	}

	/**
	 * Json NotAllowed
	 *
	 * @return \Closure
	 */
	public static function jsonNotAllowed()
	{
		return function (Container $container) {
			return new NotAllowed($container->get('settings')['displayErrorDetails']);
		};
	}
}