<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/23
 * Time: 22:00
 */

abstract class AbstructUtils
{
	protected $element = null;

	public function __call($name, $arguments)
	{
		echo 1111111;
		if(!method_exists(self,$name)) {
			throw new Exception("");
		}
		$arguments = ArrayUtil::unshift($arguments,$this->element);
		return call_user_func_array([self,$name],$arguments);
	}
}