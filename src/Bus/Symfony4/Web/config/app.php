<?php

use Illuminate\Container\Container;
use ZnCore\Base\Libs\DotEnv\DotEnv;
use App\Bus\Symfony4\Web\BusModule;
use ZnLib\Web\Symfony4\MicroApp\MicroApp;

$rootDir = realpath(__DIR__ . '/../../../../..');
require_once $rootDir . '/' . $_ENV['AUTOLOAD_SCRIPT'];
DotEnv::init($rootDir);

$container = Container::getInstance();

include __DIR__ . '/../../../../../config/container.php';

$app = new MicroApp($container);
$app->setErrorLevel(E_ALL);
$app->addModule(new BusModule());
$response = $app->run();
$response->send();
