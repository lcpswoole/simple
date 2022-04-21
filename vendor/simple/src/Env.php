<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/23
 * Time: 22:23
 */

namespace simple;
use simple\exception\MethodException;
use simple\exception\ExceptionConstants;
use simple\util\ArrayUtil;
use simple\util\StringUtil;
class Env
{
	use Singleton;

	private static $rootPath;
	private static $appPath;
	private static $configPath;
	private static $routePath;
	private static $middlewarePath;
	private static $taskPath;
	private static $staticPath;
	private static $debug = true;
	private static $envData = [];
	private static $modes = [];
	private function __construct(){
		self::$rootPath = ROOT_PATH;
		self::$appPath = ROOT_PATH.DS.APP_DIR_NAME;
		self::$configPath = APP_DIR_NAME.DS.CONFIG_DIR_NAME;
		self::$routePath = APP_DIR_NAME.DS.ROUTE_DIR_NAME;
		self::$middlewarePath = APP_DIR_NAME.DS.MIDDLEWARE_DIR_NAME;
		self::$taskPath = APP_DIR_NAME.DS.TASK_DIR_NAME;
		self::$staticPath = ROOT_PATH.DS.TASK_DIR_NAME;
	}

	public function load($mode){
		self::$modes = $mode;
		$mode = StringUtil::lower($mode['mode']);
		$envData = [];
		if($mode == "prod"){
			self::$debug = false;
			$envData = parse_ini_file(self::$root.'/prod.ini',true);
		}else{
			self::$debug = true;
			$envData = parse_ini_file(self::$root.'/dev.ini',true);
		}
		foreach ($envData as $key => $value) {
			if (is_array($value)) {
				foreach ($value as $key1 => $value1) {
					self::$envData[$key][$key1] = $value1;
				}
			}else{
				self::$envData[$key] = $value;
			}
		}
	}

	public static function getMode(){
		return self::$modes;
	}

	public static function getDebug(){
		return self::$debug;
	}

	public static function getEnv($key){
		$keys = StringUtil::split($key,".");
		$envData = Env::$envData;
		ArrayUtil::each($keys,function($key,$value)use($envData){
			if(!ArrayUtil::keyEx($envData,$value)){
				throw new MethodException(StringUtil::format(ExceptionConstants::KeyArrayError,[$key,"envData"]));
			}
			$envData = $envData[$value];
		});
		return $envData;
	}

	public static function getRootPath(){
		return self::$rootPath;
	}

	public static function getAppPath(){
		return self::$appPath;
	}

	public static function getConfigPath(){
		return self::$configPath;
	}

	public static function getRoutePath(){
		return self::$routePath;
	}

	public static function getMiddlewarePath(){
		return self::$middlewarePath;
	}

	public static function getTaskPath(){
		return self::$taskPath;
	}

	public static function getStaticPath(){
		return self::$staticPath;
	}
}