<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../../yii-1.1.7.r3135/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/development.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

if( YII_DEBUG )
{
	error_reporting(E_ALL); 
	ini_set("display_errors", 1); 
}
// cool random session generator ...
ini_set("session.entropy_file", "/dev/urandom");
ini_set("session.entropy_length", "512");

require_once($yii);
Yii::createWebApplication($config)->run();
