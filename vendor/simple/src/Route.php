<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/23
 * Time: 22:25
 */

namespace simple;

use simple\util\ArrayUtil;
use simple\util\FileUtil;

class Route
{
	use Singleton;

	private $routePath;
	private $gets = [];
	private $posts = [];
	private $anys = [];
	private $group = "";
	private $limit = [];
	private $alias = [];
	private $all = [];

	public function load(){
		$this->routePath = Env::getRoutePath();
		FileUtil::loadDirAllFiles($this->routePath);
	}

	public function group($name,callable $fun=null,$limit=[]){
		$this->group = $name;
		if(isset($limit) && is_array($limit)){
			$this->limit = $limit;
		}
		if(isset($fun)){
			$fun();
		}
		$this->group = '';
		$this->limit = [];
	}

	public function get($key,$value,$limit=[]){
		if(isset($this->group) && !empty($this->group)){
			$route = $this->group.$key;
		}
		$this->gets[$route] = $this->limit($value,$limit,$route);
	}

	public function post($route,$value){
		if(isset($this->group) && !empty($this->group)){
			$route = $this->group.$key;
		}
		$this->posts[$route] = $this->limit($value,$limit,$route);
	}

	private function limit($value,$limit,$route){
		$limit = ArrayUtil::merge($this->limit,$limit);
		if(isset($limit['prefix']) && !empty($limit['prefix'])){
			$value = $limit['prefix'].$value;
		}
		$this->all[$key] = $route;
		$limits = [];
		$limits[$key] = ['controller'=>$value];
		if(isset($limit) && is_array($limit)){
			if(in_array("middleware",$limit)){
				$limits['middleware'] = $limit['middleware'];
			}
			if(in_array("num",$limit)){
				$limits['num'] = $limit['num'];
			}
			if(in_array("as",$limit)){
				$this->alias[$limit['as']] = $value;
				$limits['as'] = $limit['as'];
			}
		}
		return $limits;
	}

	public function getAlias($alias){
		return $this->alias[$alias]??false;
	}

	public function getRoute($route){
		return $this->all[$route]??false;
	}
}