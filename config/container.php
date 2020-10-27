<?php

/**
 * @var \Illuminate\Container\Container $container
 */

use App\Bus\Domain\Repositories\Conf\ProcedureConfigRepository;
use App\Bus\Domain\Repositories\Conf\ServerRepository;

$container->bind(ServerRepository::class, function () {
    return new ServerRepository($_ENV['HOST_CONF_DIR'], new ProcedureConfigRepository());
}, true);
