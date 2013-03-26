<?php

define('APP_ROOT', '..' . DIRECTORY_SEPARATOR);
define('WWW_ROOT', APP_ROOT . 'www' . DIRECTORY_SEPARATOR);
define('LIB_ROOT', APP_ROOT . 'lib' . DIRECTORY_SEPARATOR);

// Autoloader
include LIB_ROOT . 'RSS' . DIRECTORY_SEPARATOR . 'Autoloader.php';

$classloader = new \RSS\AutoLoader('RSS', LIB_ROOT);
$classloader->register();
