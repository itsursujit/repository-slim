<?php
/**
 * Created by PhpStorm.
 * User: sujitbaniya
 * Date: 11/13/17
 * Time: 7:57 PM
 */

namespace Main\Errors;


class Error
{
	protected $data = [];
	/**
	 * Transform object to array
	 *
	 * @return array
	 */
	public function toArray()
	{
		return $this->data;
	}
	/**
	 * A unique identifier for this particular occurrence of the problem
	 *
	 * @param int $id Unique identifier
	 *
	 * @return self
	 */
	public function setId($id)
	{
		$this->data['id'] = $id;
		return $this;
	}

	/**
	 * A links object containing the following members:
	 *
	 * @param string $link   Url link
	 * @param string $key    Name. Default: self
	 * @param string $method Http method. Default: GET
	 *
	 * @return self
	 */
	public function setLink($link, $key = 'self', $method = 'GET')
	{
		if (!isset($this->data['links'])) {
			$this->data['links'] = [];
		}
		$this->data['links'][$key] = [
			'link' => $link,
			'method' => strtoupper($method)
		];
		return $this;
	}

	/**
	 * The HTTP status code applicable to this problem
	 *
	 * @param int $status HTTP status
	 *
	 * @return self
	 */
	public function setStatus($status)
	{
		$this->data['status'] = $status;
		return $this;
	}

	/**
	 * An application-specific error code
	 *
	 * @param string|integer $code Error code
	 *
	 * @return self
	 */
	public function setCode($code)
	{
		$this->data['code'] = $code;
		return $this;
	}

	/**
	 * A short, human-readable summary of the problem
	 *
	 * @param string $title Title
	 *
	 * @return self
	 */
	public function setTitle($title)
	{
		$this->data['title'] = $title;
		return $this;
	}

	/**
	 * A human-readable explanation specific to this occurrence of the problem
	 *
	 * @param string $detail Problem detail
	 *
	 * @return self
	 */
	public function setDetails($detail)
	{
		$this->data['details'] = $detail;
		return $this;
	}

	/**
	 * An object containing references to the source of the error
	 *
	 * @param array $source References to the source
	 *
	 * @return self
	 */
	public function setSource(array $source)
	{
		$this->data['source'] = $source;
		return $this;
	}

	/**
	 * A meta object containing non-standard meta-information about the error
	 *
	 * @param array $meta Meta info
	 *
	 * @return self
	 */
	public function setMeta(array $meta)
	{
		$this->data['meta'] = $meta;
		return $this;
	}
}