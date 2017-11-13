<?php
/**
 * Created by PhpStorm.
 * User: sujitbaniya
 * Date: 11/13/17
 * Time: 8:02 PM
 */

namespace Main\Errors\Handlers;


use Main\Errors\Message;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class NotAllowed extends AbstractErrorHandler
{
	const HTTP_STATUS = 405;
	const TITLE = 'Method Not Allowed';

	public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $methods = [])
	{
		return $this->response(
			$response,
			$this->render($request, $methods)
		);
	}

	protected function render(ServerRequestInterface $request, array $methods)
	{
		$detail = 'Request => '.$request->getMethod().":".$request->getUri()->__toString()
		          .'. Method not allowed. Must be one of '.implode(", ", $methods);
		$message = new Message();
		$message->add(static::TITLE, $detail)
		        ->setStatus(static::HTTP_STATUS);

		return $message;
	}
}
