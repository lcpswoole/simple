<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/23
 * Time: 22:30
 */

namespace simple;
use simple\exception\ExceptionConstants;
use simple\util\StringUtil;

trait Proxy
{
	private static $instance;

	public static function __callStatic($name, $arguments)
	{
		// TODO: Implement __callStatic() method.
		if (is_null(static::$instance)){

		}
		if(!method_exists(static::$instance,$name)){

		}
		return call_user_func_array([static::$instance,$name],$arguments);
	}
}