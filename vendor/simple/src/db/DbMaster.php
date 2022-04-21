<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/12/6
 * Time: 14:01
 */

namespace simple\db;

use simple\Env;
use simple\util\StringUtil;
use Swoole\Channel;
class DbMaster
{
	use Singleton;

	public $alias = 'db_pool';
	private $maxConnectNum = 0;
	private $minConnectNum = 0;
	private $idleConnectNum = 0;
	private $connectPool;
	private $env;
	private $driver;
	const DBNAMESPACE = '\simple\db\drivers';
	const GC_TIME = 5;
	const WAIT_TIME = 3;
	private function __construct()
	{
		$this->env = Env::getEnv('db');
		$this->maxConnectNum = $this->env['max_pool_num'];
		$this->minConnectNum = $this->env['min_pool_num'];
		$this->idleConnectNum = $this->env['idle_pool_num'];
		$this->dirver = $this->env['dirver'];
		$this->idleTime = $this->env['idle_time'];
		$this->connectPool = new Channel();
		$this->createConnect();
		$this->gc();
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
	
	public function find(){
		
	}
	
	public function selct
}