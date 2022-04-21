<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/12/6
 * Time: 18:21
 */
namespace simple\exception;

class ValidateException extends \AbstructException
{
	public function __construct($message = "", $code = 0, Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}