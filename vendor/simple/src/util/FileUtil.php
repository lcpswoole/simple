<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/24
 * Time: 22:36
 */

namespace simple\util;
class FileUtil extends AbstructUtils
{
	private $file;
	public function __construct($filePath,$mode="wb+"){
		$this->file = fopen($filePath,$mode);
	}

	public function read($length){
		return \fread($this->file,$length);
	}

	public function write($content,$length=null){
		return fwrite($this->file,$content,$length);
	}

	public function close(){
		return fclose($this->file);
	}

	public static function fread($filePath){
		return file_get_contents($filePath);
	}

	public static function fwrite($filePath,$content){
		return file_put_contents($filePath,$content);
	}

	public static function mkdir($dir){
		if(self::exists($dir)){
			return \mkdir($dir);
		}
		return false;
	}

	public static function exists($file){
		return file_exists($file);
	}

	public static function loadFile($file){
		return include_once $file;
	}

	public static function loadDirAllFiles($dir)
	{
		$files = scandir($dir);
		foreach ($files as $file) {
			if ($file == '.' || $file == '..') continue;
			self::loadFile($dir . '/' . $file);
		}
	}
}