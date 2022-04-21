<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/28
 * Time: 19:00
 */

namespace simple\validate;

use simple\Config;
use simple\Env;
use simple\exception\ExceptionConstants;
use simple\exception\ValidateException;
use simple\util\ArrayUtil;
use simple\util\StringUtil;

class Validate
{
	protected $reqData = [];
	protected $ruleData = [];
	protected $ruleErrData = [];
	protected $all = false;
	private $lang = 'ZN';

	protected function __construct($reqData=[],$ruleData=[],$ruleErrData=[],$all=false)
	{
		if(isset($reqData) && !empty($reqData)){
			$this->reqData = $reqData;
		}
		if(isset($ruleData) && !empty($ruleData)){
			$this->ruleData = $ruleData;
		}
		if(isset($ruleErrData) && !empty($ruleErrData)){
			$this->ruleErrData = $ruleErrData;
		}
		$this->all = $this->all? :$all;
		$lang = Config::getConfig('validate_lang');
		if(isset($lang) && !empty($lang)){
			$this->lang = StringUtil::upper($lang);
		}
	}

	public static function checkData(Validate $validate,...$params){
		return (new $validate(...$params))->check();
	}

	public function check(){
		$validateRes = [];
		foreach($this->reqData as $key=>$value){
			if (isset($this->ruleData[$key])){
				$rules = StringUtil::split($this->ruleData[$key],',');
				foreach($rules as $key1=>$rule){
					$tempRes = [];
					switch ($rule){
						case StringUtil::strpos($rule,\ValidateRuleConstants::BETWEEN):
							$res = StringUtil::split($rule,':')[1];
							list($startVal,$endVal) = StringUtil::split($res,'-');
							$tempRes = ValidateFunctions::between($value,$startVal,$endVal);
							break;
						case StringUtil::strpos($rule,\ValidateRuleConstants::INARRAY):
							$res = StringUtil::split($rule,':')[1];
							$limits = StringUtil::split($res,'|');
							$tempRes = ValidateFunctions::inArray($value,$limits);
							break;
						case StringUtil::strpos($rule,\ValidateRuleConstants::ISEQUAL):
							$res = StringUtil::split($rule,':')[1];
							$limits = StringUtil::split($res,'|');
							$tempRes = ValidateFunctions::isEqual($value,...$limits);
							break;
						case \ValidateRuleConstants::ISREQUIRE:
							$tempRes = ValidateFunctions::isRequire($value);
							break;
						case \ValidateRuleConstants::NOTEMPTY:
							$tempRes = ValidateFunctions::isNotEmpty($value);
							break;
						case \ValidateRuleConstants::ISEMPTY:
							$tempRes = ValidateFunctions::isEmpty($value);
							break;
						case \ValidateRuleConstants::ISINT:
							$tempRes = ValidateFunctions::isInt($value);
							break;
						case \ValidateRuleConstants::ISSTRING:
							$tempRes = ValidateFunctions::isString($value);
							break;
						case \ValidateRuleConstants::ISNUMBER:
							$tempRes = ValidateFunctions::isNumber($value);
							break;
						if ($tempRes == false){
							$keyName = $key.$rule;
							$errmsg = $this->ruleErrData[$keyName]? : $tempRes['errmsg'];
							if($this->all==false){
								$data = ['result'=>$tempRes['res'],'errkey'=>$key,'errmsg'=>$errmsg];
								throw new ValidateException(StringUtil::format(ExceptionConstants::ValidateError,$data));
							}else{
								$validateRes['result']=false;
								$validateRes['errkey'][$key][] = $errmsg;
							}
						}
					}
				};
			}
		};
		if(isset($validateRes) && !empty($validateRes)){
			$data = json_encode($validateRes);
			throw new ValidateException(StringUtil::format(ExceptionConstants::ValidateError,$data));
		}
	}
}