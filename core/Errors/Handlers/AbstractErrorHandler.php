<?php
/**
 * Created by PhpStorm.
 * User: sujitbaniya
 * Date: 11/13/17
 * Time: 7:50 PM
 */

namespace Main\Errors\Handlers;


use Psr\Http\Message\ResponseInterface;

abstract class AbstractErrorHandler
{
	const HTTP_STATUS = 500;

	protected $displayErrorDetails;

	/**
	 * Constructor
	 *
	 * @param bool $displayErrorDetails Set to true to display full details
	 */
	public function __construct($displayErrorDetails = false)
	{
		$this->displayErrorDetails = (bool) $displayErrorDetails;
	}
	/**
	 * Transforma la respuesta en json
	 *
	 * @param ResponseInterface $response Instancia de ResponseInterface
	 * @param mixed             $output   String de respuesta en formato JSON
	 *
	 * @return ResponseInterface
	 */
	protected function response(ResponseInterface $response, $output)
	{
		return $response->withJson($output, static::HTTP_STATUS);
	}
}