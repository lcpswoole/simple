<?php
/**
 * Created by PhpStorm.
 * User: brook·Lee
 * Date: 2021/11/24
 * Time: 21:36
 */
namespace app;
define(ROOT_PATH,__DIR__);
define(DS,DIRECTORY_SEPARATOR);
define(APP_DIR_NAME,"app");
define(CONFIG_DIR_NAME,"config");
define(ROUTE_DIR_NAME,"route");
define(MIDDLEWARE_DIR_NAME,"route");
define(TASK_DIR_NAME,"task");
define(STATIC_DIR_NAME,"static");
(new \Application($argv));