<?php

namespace App\Rpc\Symfony4\Web;

use App\Rpc\Symfony4\Web\Controllers\DefaultController;
use Illuminate\Container\Container;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Rpc\Domain\Repositories\Conf\HostsRepository;
use App\Rpc\Domain\Repositories\Conf\ServerRepository;
use App\Rpc\Symfony4\Web\Controllers\RpcController;
use ZnLib\Web\Symfony4\MicroApp\BaseModule;

class RpcModule extends BaseModule
{

    public function configContainer(Container $container)
    {
        //todo: move to domain config "container.php"
        $container->bind(ServerRepository::class, function () {
            return new ServerRepository($_ENV['HOST_CONF_DIR'], new HostsRepository());
        }, true);
    }

    public function configRoutes(RouteCollection $routes)
    {
        $routes->add('rpc_index', new Route('/', [
            '_controller' => DefaultController::class,
            '_action' => 'index',
        ]));
        $routes->add('rpc_json_example', new Route('/json-rpc', [
            '_controller' => RpcController::class,
            '_action' => 'jsonExample',
        ]));
    }
}
