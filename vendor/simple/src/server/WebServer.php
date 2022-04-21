<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/24
 * Time: 21:31
 */

namespace simple\server;

use simple\Env;
use Swoole\Server\WebSocket;
class WebServer
{
	private $server;
	public function __construct(){
		$host = Env::getEnv("websocket.host");
		$port = Env::getEnv("websocket.port");
		$this->server = new WebSocket($host,$port);
		$this->set();
		$this->server->on();
	}

	private function set(){

	}

	private function onStart(){

	}

	private function onRequest(){

	}

	private function onWorkStart(){

	}
}