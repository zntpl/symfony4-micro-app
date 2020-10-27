<?php

use common\Bootstrap\Autoloader;

include_once(__DIR__ . '/../../common/Bootstrap/Autoloader.php');
$rootDir = realpath(__DIR__ . '/../..');
Autoloader::bootstrapVendor($rootDir);
