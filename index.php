<?php
 
require_once 'libs\Autoloader.php';
require 'config/Config.php';

spl_autoload_register('load');
session_start();

$router = new Router();
$router->run();

