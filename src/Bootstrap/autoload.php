<?php

use App\Bootstrap\Autoloader;

include_once(__DIR__ . '/Autoloader.php');
$rootDir = realpath(__DIR__ . '/../..');
Autoloader::bootstrapVendor($rootDir);
