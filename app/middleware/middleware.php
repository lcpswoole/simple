<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/27
 * Time: 22:01
 */

return [
	//别名=>类名@方法
	'master_start'=>'\app\middleware\MasterStartListen::class@handle',
	'worker_start'=>'\app\middleware\WorkerStartListen::class@handle',
];