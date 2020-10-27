<?php

use Illuminate\Container\Container;
use ZnCore\Base\Libs\DotEnv\DotEnv;
use ZnLib\Web\Symfony4\MicroApp\MicroApp;

DotEnv::init();

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
