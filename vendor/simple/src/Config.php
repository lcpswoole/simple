<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/23
 * Time: 22:23
 */

namespace simple;
use simple\util\ArrayUtil;
use simple\util\StringUtil;
class Config
{
	use Singleton;

	private $configPath;
	private function __construct(){
		$this->configPath = Env::getConfigPath();
		$this->load();
	}

	public function load(){
		$configs = scandir($this->configPath);
		foreach ($configs as $value) {
			if ($value== '.' || $value=='..') continue;
			$tempConfigs = include_once($this->configPath.'/'.$value);
			$key = StringUtil::split($value,'.')[0];
			self::$configs[$key] = $value;
		}
	}

	public static function getConfig($key){
		$keys = StringUtil::split($key,'.');
		$configData = self::$configs;
		ArrayUtil::each($keys,function($k,$v)use($configData){
			if(!ArrayUtil::keyEx($configs,$v)){
				throw new MethodException(StringUtil::format(ExceptionConstants::KeyArrayError,[$key,"envData"]));
			}
			$configData = $configData[$v];
		});
		return $configData;
	}

	public static function setConfig($key,$value){
		$count = StringUtil::split($key,'.');
		if($count == 1){
			list($k) = StringUtil::split($key,'.');
			self:;$configs[$k] = $value;
		}elseif($count == 2){
			list($k,$k1) = StringUtil::split($key,'.');
			self::$configs[$k][$k1] = $value;
		}elseif($count == 3){
			list($k,$k1,$k2) = StringUtil::split($key,'.');
			self::$configs[$k][$k1][$k2] = $value;
		}else{
			throw new \MethodException();
		}
	}
}