<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/28
 * Time: 19:01
 */

class ValidateRuleConstants
{
	//英文
	const NOTEMPTY_EN = "%s Cannot be empty";
	const ISEMPTY_EN = '%s Must be empty';
	const BETWEEN_EN = '%s Must be between %s and %s';
	const INARRAY_EN = '%s Must be equal to %s';
	const ISREQUIRE_EN = '%s Field does not exist';
	const ISPHONE_EN = '%s The phone number is wrong';
	const ISEMAIL_EN = '%s The mailbox is wrong';
	const ISINT_EN = '%s is not a int type';
	const ISSTRING_EN = '%s is not a string type';
	const ISNUMBER_EN = '%s is not a numeric type';
	const ISEQUAL_EN = '%s is not equal to %s';

	//中文
	const NOTEMPTY_CN = "%s 不能为空";
	const ISEMPTY_CN = '%s 必须为空';
	const BETWEEN_CN = '%s 必须在%s和%s之间';
	const INARRAY_CN = '%s 必须是在 %s其中得一个';
	const ISREQUIRE_CN = '%s 字段不存在';
	const ISPHONE_CN = '%s 电话号码格式错误';
	const ISEMAIL_CN = '%s 邮箱格式错误';
	const ISINT_CN = '%s 不是数字类型';
	const ISSTRING_CN = '%s 不是字符串类型';
	const ISNUMBER_CN = '%s 不是数字或者数字字符串类型';
	const ISEQUAL_CN = '%s 不等于%s';
}