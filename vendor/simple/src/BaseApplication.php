<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/23
 * Time: 22:25
 */

namespace simple;
use Env;
use simple\server\WebServer;
use simple\util\StringUtil;

class BaseApplication
{
	public function __construct($argv)
	{
		switch ($argv[1]){
			case "start":
				$this->getEnv($argv[2]);
				$this->getConfig();
				$this->getRoutes();
				$this->startServer();
				$this->startTask();
		}
	}

	protected function getEnv($mode){
		$modes = explode(",",$mode);
		$modeArr = [];
		ArrayUtil::each($modes,function ($key,$value)use(&$modeArr){
			$tempArrs = explode("=",$value);
			$modeArr[$tempArrs[0]] = $tempArrs[$tempArrs[1]];
		});
		Env::getInstance()->load($modeArr);
	}

	protected function getConfig(){
		Config::getInstance()->load();
	}

	protected function getMiddleware(){
		Middleware::getInstance()->load();
	}

	protected function getRoutes(){
		Route::getInstance()->load();
	}

	protected function loadhelper(){
		include_once Env::getAppPath()."/helper.php";

	}
	
	protected function loadDb(){
		Db::getInstance()->load();
	}
	
	protected function startServer(){
		$modes = Env::getMode();
		$server = $modes['server']? :Env::getEnv('server');
		$server = StringUtil::lower($server);
		switch ($server){
			case 'tcpserver':
				break;
			case 'udpserver':
				break;
			case 'webserver':
				(new WebServer())->start();
				break;
		}
	}

	protected function startTask(){

	}
	
	protected function sign(){
		Console::success(
			''
		)
	}
}