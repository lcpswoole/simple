<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/23
 * Time: 22:23
 */

namespace simple;
use simple\util\FileUtil;
use simple\util\StringUtil;

class Middleware
{
	use Singleton;

	private $middlewarePath;
	private $middlewareConfig;
	private function __construct(){
		$this->middlewarePath = Env::getMiddlewarePath();
	}

	public function load(){
		$middlewareFile = $this->middlewarePath.'/middleware.php';
		if(FileUtil::exists($middlewareFile)){
			$this->middlewareConfig = FileUtil::loadFile($middlewareFile);
		}
	}

	public function exec($listen,...$params){
		$config = $this->middlewareConfig[$listen];
		if(isset($config) && !empty($config)){
			list($listenClass,$listenAction) = StringUtil::split($config,"@");
			$result = call_user_func_array([(new $listenClass(),$listenAction],$params);
			if($result instanceof )
		}
	}
}