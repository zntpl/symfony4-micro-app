<?php

use Illuminate\Container\Container;
use ZnCore\Base\Libs\DotEnv\DotEnv;
use App\Rpc\Symfony4\Web\RpcModule;
use ZnLib\Web\Symfony4\MicroApp\MicroApp;

$rootDir = realpath(__DIR__ . '/../../../../..');
require_once $rootDir . '/' . $_ENV['AUTOLOAD_SCRIPT'];
DotEnv::init($rootDir);

$container = Container::getInstance();

$app = new MicroApp($container);
$app->setErrorLevel(E_ALL);
$app->addModule(new RpcModule());
$response = $app->run();
$response->send();
