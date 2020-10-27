<?php

use Illuminate\Container\Container;
use ZnCore\Base\Libs\DotEnv\DotEnv;
use ZnLib\Web\Symfony4\MicroApp\MicroApp;

$rootDir = realpath(__DIR__ . '/../../../symfony4-micro-app');
require_once $rootDir . '/' . $_ENV['AUTOLOAD_SCRIPT'];
DotEnv::init($rootDir);

$container = Container::getInstance();

include __DIR__ . '/../../config/container.php';

$app = new MicroApp($container);
$app->setErrorLevel(E_ALL);

$modulesConfig = include (__DIR__ . '/../../config/modules.php');
foreach ($modulesConfig as $moduleClass) {
    $moduleInstance = $container->get($moduleClass);
    $app->addModule($moduleInstance);
}
$response = $app->run();
$response->send();
