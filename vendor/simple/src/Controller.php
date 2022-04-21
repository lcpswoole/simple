<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/24
 * Time: 22:35
 */

namespace simple;
use simple\validate\Validate;
use simple\validate\ValidateFunctions;

class Controller
{
	public function __construct()
	{

	}

	public function toJson(){

	}

	public function validate(Validate $validate,...$params){
		Validate::checkData($validate,$params);
	}
}