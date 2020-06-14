<?php
//linux
define('APP_PATH', __DIR__ . '/../application/');
require_once __DIR__ . '/biquan/config.php';
define('BIND_MODULE','socket/Bqworker');
require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/../thinkphp/start.php';