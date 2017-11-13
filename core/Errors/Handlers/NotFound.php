<?php
/**
 * Created by PhpStorm.
 * User: sujitbaniya
 * Date: 11/13/17
 * Time: 8:03 PM
 */

namespace Main\Errors\Handlers;


use Main\Errors\Message;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class NotFound extends AbstractErrorHandler
{
	const HTTP_STATUS = 404;
	const TITLE = 'Page not found';

	public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
	{
		return $this->response(
			$response,
			$this->render($request)
		);
	}

	protected function render(ServerRequestInterface $request)
	{
		$message = new Message();
		$message->add(static::TITLE, 'Request => '.$request->getMethod().":".$request->getUri()->__toString())
		        ->setStatus(static::HTTP_STATUS);

		return $message;
	}
}