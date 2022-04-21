<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/12/6
 * Time: 14:00
 */

namespace simple\db\dirvers;

use simple\util\StringUtil;

class Mysql
{
	private $master;
	public function __construct($host,$port,$user,$pass,$db)
	{
		$connect = StringUtil::format("%s:host=%s;dbname=%s, %s, %s",[$host,$port,$user,$pass,$db]);
		$this->master = new \Pdo($connect);
		$this->master->query('set names uft8');
	}
}