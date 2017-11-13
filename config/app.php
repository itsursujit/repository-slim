<?php
/**
 * Created by PhpStorm.
 * User: sujitbaniya
 * Date: 11/12/17
 * Time: 9:23 PM
 */

use Main\Errors\BuilderJsonErrorResponse;
use Main\MySQLPersistent;

return [
    'environment' => 'dev', //prod or dev
	'app' => [
		'settings.responseChunkSize' => 4096,
		'settings.outputBuffering' => 'append',
		'settings.determineRouteBeforeAppMiddleware' => true,
		'settings.displayErrorDetails' => true,
        'settings.addContentLengthHeader' => false,

		'errorHandler' => BuilderJsonErrorResponse::jsonError(),
		'phpErrorHandler' => BuilderJsonErrorResponse::jsonPhpError(),
		'notFoundHandler' => BuilderJsonErrorResponse::jsonNotFound(),
		'notAllowedHandler' => BuilderJsonErrorResponse::jsonNotAllowed(),

        "persistent" => \DI\object(MySQLPersistent::class), //Change this to change the db persistent
	],
	'view' => [
		'name' => 'Twig',
		'path' => APP_PATH . '/Views',
		'cache' => STORAGE_PATH . '/views/cache',
        'allow_cache' => false,
	],
	'http_cache' => true
];