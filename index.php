<?php
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('您的PHP版本过低，请升级到5.3.0以上！！！');

define('APP_NAME','APP');
define('APP_PATH','./APP/');
define('APP_DEBUG',true);
require('./ThinkPHP/ThinkPHP.php');
