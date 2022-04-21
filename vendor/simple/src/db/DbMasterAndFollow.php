<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/12/6
 * Time: 14:01
 */

namespace simple\db;

use simple\Env;
use simple\util\ArrayUtil;
use simple\util\StringUtil;
use Swoole\Channel;
class DbMasterAndFollow
{
	use Singleton;

	public $alias = 'db_pool';
	private $maxConnectNum = 0;
	private $minConnectNum = 0;
	private $idleConnectNum = 0;
	private $masterConnectPool;
	private $followConnectPool;
	private $env;
	private $driver;
	const DBNAMESPACE = '\simple\db\drivers';
	const GC_TIME = 5;
	const WAIT_TIME = 3;
	private function __construct()
	{
		$this->env = Env::getEnv('db');
		$this->maxConnectNum = StringUtil::split($this->env['max_pool_num']);
		$this->minConnectNum = StringUtil::split($this->env['min_pool_num']);
		$this->idleConnectNum = StringUtil::split($this->env['idle_pool_num']);
		$this->dirver = $this->env['dirver'];
		$this->idleTime = $this->env['idle_time'];
		$this->connectPool = new Channel();
		$this->createConnect();
		$this->gc();
	}

	private function createMasterConnect(){
		$hosts = StringUtil::split($this->env['host'],',');
		$ports = StringUtil::split($this->env['port'],',');
		$users = StringUtil::split($this->env['user'],',');
		$passs = StringUtil::split($this->env['pass'],',');
		$db = $this->env['db'];
		for ($i=0;$i<$this->minConnectNum[0];$i++){
			$driver = self::DBNAMESPACE.'\\'.StringUtil::ucfirst($this->dirver);
			$connect = new $driver($hosts[0],$port[0],$user[0],$passs[0],$db);
			$this->masterConnectPool->push($connect);
		}
	}

	private function createFollowConnect(){
		$hosts = StringUtil::split($this->env['host'],',');
		$ports = StringUtil::split($this->env['port'],',');
		$users = StringUtil::split($this->env['user'],',');
		$passs = StringUtil::split($this->env['pass'],',');
		$db = $this->env['db'];
		for ($i=1;$i<ArrayUtil::length($hosts);$i++){
			for ($i=0;$i<$this->minConnectNum[$i];$i++){
				$driver = self::DBNAMESPACE.'\\'.StringUtil::ucfirst($this->dirver);
				$connect = new $driver($hosts[0],$port[0],$user[0],$passs[0],$db);
				$this->followConnectPool->push($connect);
			}
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