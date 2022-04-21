<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/28
 * Time: 18:47
 */

namespace simple\response;
use simple\util\ArrayUtil;

class Json
{
	private $body;
	private $headers;
	private $status;
	public function __construct($body,Array $headers=[],$status=ResponseConstants::SUCCESS)
	{
		$this->status = $status;
		if(isset($headers) && !empty($headers)){
			ArrayUtil::each($headers,function($key,$value){
				$this->addHeader($value);
			});
		}
	}

	public function addHeader($header){
		$this->headers[] = $header;
	}

	public function addStatusCode($status){
		$this->status = $status;
	}

	public function output(){
		ArrayUtil::each($this->headers,function($key,$value){
			header($value);
		});
		echo json_encode($this->body);
	}
}