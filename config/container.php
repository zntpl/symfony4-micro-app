<?php

/**
 * @var \Illuminate\Container\Container $container
 */

use App\Bus\Domain\Repositories\Conf\ProcedureConfigRepository;

$container->bind(ProcedureConfigRepository::class, function () {
    $config = include __DIR__ . '/bus.php';
    return new ProcedureConfigRepository($config);
}, true);
