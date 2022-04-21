<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/23
 * Time: 22:37
 */

namespace simple;

use simple\util\ArrayUtil;
use simple\util\StringUtil;
class Container
{
	public static $instances = [];
	public static function set($key,$value){
		self::$instances[$key] = $value;
	}

	public static function get($key){
		return self::$instances[$key];
	}

	public static function exists($key){
		return ArrayUtil::keyEx(self::$instances,$key);
	}
}