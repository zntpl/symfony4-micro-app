<?php

use ZnCore\Base\Libs\DotEnv\DotEnv;

$_ENV['APP_ENV'] = 'test';
//$_ENV['API_URL'] = 'http://micro-app.tpl/json-rpc/';
DotEnv::init();
//dd(getenv('API_URL'));
$_ENV['PROJECT_DIR'] = realpath(__DIR__ . '/..');
//$_ENV['APP_DIR'] = realpath(__DIR__ . '/../console');
//$_ENV['APP_NAME'] = 'console';


//restore_error_handler();
