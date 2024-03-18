<?php
define('_SERVER_NAME', 'localhost:80'); /*Moze byc tez samo localhost*/
define('_SERVER_URL', 'http://'._SERVER_NAME);
define('_APP_ROOT', '/kalk_kredyt'); /*katalog w ktorym jest - od htdocks*/
define('_APP_URL', _SERVER_URL._APP_ROOT);
define("_ROOT_PATH", dirname(__FILE__));
?>