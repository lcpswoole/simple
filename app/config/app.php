<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/12/3
 * Time: 21:08
 */
return [
	'replace_system'=>[
		//要替换得系统得类别名（env、config、middleware、route）
	],
	'db_pool'=>[
		'exception'=>'', //获取数据库连接超时得处理异常类
	]
	'modules' =>[
		'index'
	],
	'validate_selected'=>1,//1:抛异常 2:返回异常信息
	'validate_result'=>'',//必须继承ValidateResult
	'validate_lang'=>'en',//en:英文 ch:中文
];