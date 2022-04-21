<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/23
 * Time: 22:46
 */
use simple\Env;
use simple\Route;
use simple\Container;
use simple\Config;
if(function_exists('app')){
	function app($key){
		Container::get($key);
	}
}

if(function_exists('env')) {
	function env($key)
	{
		return Env::get($key);
	}
}

if(function_exists('route')) {
	function route($key)
	{
		return Route::getAlias($key);
	}
}

if(function_exists('middleware')) {
	function middleware()
	{
		return Middleware::
	}
}

if(function_exists('config')) {
	function config($key)
	{
		return Config::get($key);
	}
}

if(function_exists('cache')) {
	function cache($){

	}
}

if(function_exists('console_success')) {
	function console_success($content,$bgColor='',$line=false){
		\simple\Console::success($content,$bgColor,$line);
	}
}

if(function_exists('console_fail')) {
	function console_success($content,$bgColor='',$line=false){
		\simple\Console::fail($content,$bgColor,$line);
	}
}

if(function_exists('console_warning')) {
	function console_success($content,$bgColor='',$line=false){
		\simple\Console::warning($content,$bgColor,$line);
	}
}

if(function_exists('printf')) {
	function printf($str,...$formatData){
		\simple\util\StringUtil::format($str,$formatData);
	}
}