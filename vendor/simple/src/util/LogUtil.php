<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/25
 * Time: 23:05
 */

namespace simple\util;
use simple\Env;
class LogUtil
{
	use Singleton;
	private $level;
	private $time;
	private $format;
	private function __construct()
	{
		$this->level = Env::getAppPath("log.level");
		$this->time = Env::getAppPath("log.time");
		$this->format = Env::getAppPath("log.format");
	}

	public function write($content){
		if($this->time == 'd'){
			FileUtil::fwrite(date("Y{$this->format}m{$this->format}d").'.log',$content);
		}else{
			$date = date("Y-m-d");
			if(FileUtil::exists($date)){
				FileUtil::mkdir($date);
			}
			FileUtil::fwrite(date("Y{$this->format}m{$this->format}d{$this->format}H").'.log',$content);
		}
		return true;
	}
	
}