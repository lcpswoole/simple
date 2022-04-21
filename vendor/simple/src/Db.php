<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/12/6
 * Time: 14:01
 */

namespace simple;

use simple\db\DbMaster;
use simple\db\DbMasterAndFollow;
use simple\Env;
use simple\util\StringUtil;
use Swoole\Channel;
class Db
{
	use Singleton;
	use Proxy;

	public $alias = 'db';
	private $env;
	private $dbPool;
	private function __construct()
	{
		$this->env = Env::getEnv('DbPool');
	}

	public function load(){
		$mode = $this->env['mode'];
		if($mode==0){
			$this->dbPool = DbMaster::getInstance();
		}elseif($mode==1){
			$this->dbPool = DbMasterAndFollow::getInstance();
		}
	}

	private function createConnect(){
		$host = $this->env['host'];
		$port = $this->env['port'];
		$user = $this->env['user'];
		$pass = $this->env['pass'];
		$db = $this->env['db'];
		$mode = $this->env['mode'];
		for ($i=0;$i<$this->minConnectNum;$i++){
			$driver = self::DBNAMESPACE.'\\'.StringUtil::ucfirst($this->dirver);
			$connect = new $driver($host,$port,$user,$pass,$db);
			$this->connectPool->push($connect);
		}
	}

	public function get(){
		$num = $this->connectPool->length();
		if($num == 0 && $num<$this->maxConnectNum){
			$this->createConnect();
		}
		$connect = $this->connectPool->pop(self::WAIT_TIME);
		if(!isset($connect) || empty($connect)){
			throw new Excepiton();
		}
		$connect->time = time();
	}

	public function push($connect){
		$this->connectPool->push($connect);
	}

	private function gc(){
		swoole_time(function(){

		},self::GC_TIME);
		if($this->connectPool->length()>$this->minContectNum) {
			foreach ($this->connectPool as $connect) {
				if($connect->time-time()>$this->idleTime){
					$connect->close();
					$this->connectPool->pop();
				}
			}
		}
	}
}