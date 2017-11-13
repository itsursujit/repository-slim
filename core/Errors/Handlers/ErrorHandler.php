<?php
/**
 * Created by PhpStorm.
 * User: sujitbaniya
 * Date: 11/13/17
 * Time: 7:53 PM
 */

namespace Main\Errors\Handlers;


use Main\Errors\Message;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class ErrorHandler extends AbstractErrorHandler
{
	const TITLE = "Internal server error";

	private $view;

	public function __construct( Twig $view, $displayErrorDetails = false ) {
		$this->view = $view;
		parent::__construct( $displayErrorDetails );
	}

	public function __invoke(Request $request, Response $response, \Exception $exception) {

		return $this->response(
			$response,
			$this->render($exception)
		);
	}

	protected function render(\Throwable $error)
	{
		$message = new Message();
		$e = $message->add(static::TITLE, $error->getMessage())
		             ->setStatus(static::HTTP_STATUS)
		             ->setCode($error->getCode());

		if ($this->displayErrorDetails) {
			$e->setSource(
				[
					'file' => $error->getFile(),
					'line' => $error->getLine()
				]
			)->setMeta(
				[
					'trace' => explode("\n", $error->getTraceAsString())
				]
			);
		}

		return $message;
	}
}