<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/12/3
 * Time: 20:20
 */
class My{

	private $a = "111";
	private $b = "333";

	public function __sleep()
	{
		// TODO: Implement __sleep() method.
		return ['a'=>'a','b'=>'b'];
	}

	public function __wakeup()
	{
		// TODO: Implement __wakeup() method.
		echo '__wakeup';
	}

	public function __toString()
	{
		// TODO: Implement __toString() method.
		return "1111111111";
	}

	public function index(){
		echo 1111;
	}

	public static function index1(){
		echo 1111;
	}

	public function __call($name, $arguments)
	{
		// TODO: Implement __call() method.
		echo $name;
	}

	public static function __callStatic($name, $arguments)
	{
		// TODO: Implement __callStatic() method.
		echo $name;
	}
}
//My::index();
echo (new My());
$my = new My();
echo serialize($my);
echo unserialize(serialize($my));
