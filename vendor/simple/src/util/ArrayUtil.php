<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/23
 * Time: 19:58
 */
namespace simple\util;
class ArrayUtil {

	public function __call($name, $arguments)
	{
		echo 1111111;
		if(!method_exists(self,$name)) {
			throw new Exception("");
		}
		$arguments = ArrayUtil::unshift($arguments,$this->element);
		return call_user_func_array([self,$name],$arguments);
	}

	public static function push($arr,$val){
		$arr[] = $val;
		return $arr;
	}

	public static function pop($arr){
		array_pop($arr);
		return $arr;
	}

	public static function shift($arr){
		array_shift($arr);
		return $arr;
	}

	public static function unshift($arr,$val){
		array_unshift($arr,$val);
		return $arr;
	}

	public static function filter($arr,callable $fun){
		if (is_null($fun)){
			$arr = array_filter($arr);
		}else{
			$arr = array_filter($arr,$fun);
		}
		return $arr;
	}

	public static function walk($arr,callable $fun){
		return array_walk($arr,$fun);
	}

	public static function each($arr,callable $fun){
		$tempArr = [];
		foreach($arr as $key=>$value){
			$temp = $fun($key,$value);
			if (isset($temp)){
				$tempArr[] = $temp;
			}
		}
		return $tempArr;
	}

	public static function length($arr){
		return count($arr);
	}

	public static function inArray($arr,$key){
		return in_array($key,$arr);
	}

	public static function sort($arr){
		return \sort($arr);
	}

	public static function keys($arr){
		return array_keys($arr);
	}

	public static function values($arr){
		return array_values($arr);
	}

	public static function keyEx($arr,$key){
		return array_key_exists($key,$arr);
	}

	public static function search($arr,$key,$strict=false){
		return array_search($key,$arr,$strict);
	}

	public static function column($arr,$key,$value){
		return array_column($arr,$key,$value);
	}

	public static function merge($arr,$arr1){
		return array_merge($arr,$arr1);
	}
}
$arr = [1,2,3,4];
echo $arr->search(4);
echo ArrayUtil::search($arr,4);
$arr1 = [];
$str = "";
$arr1 = ArrayUtil::each($arr,function ($key,$value)use(&$str){
	if($value>2){
		$str=$str.strval($key);
		return $key;
	}
});
var_dump($arr1);
var_dump($str);