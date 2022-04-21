<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/23
 * Time: 21:58
 */

namespace simple\util;
class StringUtil
{

	public static function trim($str){
		return \trim($str);
	}

	public static function replace($str,$src,$replace){
		return str_replace($str,$src,$replace);
	}

	public static function strpos($str,$sub){
		return \strpos($str,$sub);
	}

	public static function length($arr){
		return strlen($arr);
	}

	public static function lower($str){
		return strtolower($str);
	}

	public static function upper($str){
		return strtoupper($str);
	}
	public static function format($str,$formatArr){
		return sprintf($str,...$formatArr);
	}

	public static function split($str,$sign){
		return explode($sign,$str);
	}

	public static function ucfirst($str){
		return ucfirst($str);
	}
}