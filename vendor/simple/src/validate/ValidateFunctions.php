<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/28
 * Time: 19:17
 */

namespace simple\validate;
use simple\util\ArrayUtil;
use simple\util\StringUtil;

class ValidateFunctions
{
	public static function notEmpty($value){
		return !empty($value);
	}

	public static function isNotEmpty(){
		return empty($value) ? false : true;
	}

	public static function isEmpty(){
		return empty($value) ? true :false;
	}
	
	public static function between($value,$params){
		$params = StringUtil::split($params,',');
		$paramsMin = $params[0];
		$paramsMax = $params[1];
		$paramsArr = range($paramsMin,$paramsMax);
		return ArrayUtil::inArray($paramsArr,$value);
	}

	public static function inArray($value,$params){
		$params = StringUtil::split($params,',');
		$paramsMin = $params[0];
		$paramsMax = $params[1];
		$paramsArr = range($paramsMin,$paramsMax);
		return ArrayUtil::inArray($paramsArr,$value);
	}

	public static function isRequire($value){
		return isset($value);
	}

	public static function isPhone($value){

	}

	public static function isEmail(){

	}

	public static function isInt($value){
		return is_int($value);
	}

	public static function isString($value){
		return is_string($value);
	}

	public static function isNumber($value){
		return is_numeric($value);
	}

	public static function isEqual($value,$value1,$strict=false){
		if($strict){
			return $value === $value1;
		}else{
			return $value == $value1;
		}
	}
}