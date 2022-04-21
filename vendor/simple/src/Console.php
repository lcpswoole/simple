<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/12/5
 * Time: 1:12
 */

namespace simple;


class Console
{
	private const FOREGROUNDCOLORS = [
		'black'=>'0;30',
		'dark_gray'=>'1;30',
		'blue'=>'0;34',
		'light_blue'=>'1;34',
		'green'=>'0;32',
		'light_green'=>'1;32',
		'cyan'=>'0;36',
		'light_cyan'=>'1;36',
		'red'=>'0;31',
		'light_red'=>'1;31',
		'purple'=>'0;35',
		'light_purple'=>'1;35',
		'brown'=>'0;33',
		'yellow'=>'1;33',
		'light_gray'=>'0;37',
		'white'=>'1;37',
	];
	private const BACKGROUNDCOlORS = [
		'black'=>'40',
		'red'=>'41',
		'green'=>'42',
		'yellow'=>'43',
		'blue'=>'44',
		'magenta'=>'45',
		'cyan'=>'46',
		'light_gray'=>'47',
	];

	public static function success($content,$bgColor='',$line=false){
		if(isset($bgColor) && !empty($bgColor)){
			self::fgAndBgColor($content,'green',$bgColor,$line);
		}else{
			self::fgColor($content,'green',$line);
		}
	}

	public static function fail($content,$bgColor='',$line=false){
		if(isset($bgColor) && !empty($bgColor)){
			self::fgAndBgColor($content,'red',$bgColor,$line);
		}else {
			self::fgColor($content, 'red',$line);
		}
	}
	
	public static function warning($content,$bgColor='',$line=false){
		if(isset($bgColor) && !empty($bgColor)){
			self::fgAndBgColor($content,'yellow',$bgColor,$line);
		}else {
			self::fgColor($content, 'yellow',$line);
		}
	}

	private static function fgColor($content,$foregroundColor,$line=false){
		$foregroundColor = self::FOREGROUNDCOLORS[$foregroundColor];
		$line = $line ? chr(27).'[4m' : '';
		echo chr(27) . "[{$foregroundColor}m" . "$line $content" . chr(27) . "[0m";
	}

	private static function fgAndBgColor($content,$foregroundColor,$backgroundColor,$line=false){
		$foregroundColor = self::FOREGROUNDCOLORS[$foregroundColor];
		$backgroundColor = self::BACKGROUNDCOlORS[$backgroundColor];
		$line = $line ? chr(27).'[4m' : '';
		echo chr(27) . "[{$foregroundColor}m" . chr(27)."[{$backgroundColor}m"."$line $content" .chr(27). "[0m";
	}
	
}
Console::success("哈哈哈",'',true);
Console::fail("哈哈哈",'',true);
Console::warning('哈哈哈');
Console::success("哈哈哈",'red',true);
Console::warning("哈哈哈",'yellow',true);
