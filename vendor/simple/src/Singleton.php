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

trait Singleton
{
	private static $instance;

	public static function getInstance(...$params){
		if (is_null(static::$instance)){
			$instance = new static(...$params);
			static::$instance = $instance;
			if (property_exists($instance,"alias")){
				Container::set($instance->alias,static::$instance);
			}
			Container::set(static::class,static::$instance);
		}
		return static::$instance;
	}

}