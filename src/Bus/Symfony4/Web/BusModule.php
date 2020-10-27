<?php

namespace App\Bus\Symfony4\Web;

use App\Bus\Symfony4\Web\Controllers\DefaultController;
use Illuminate\Container\Container;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Bus\Domain\Repositories\Conf\HostsRepository;
use App\Bus\Domain\Repositories\Conf\ServerRepository;
use App\Bus\Symfony4\Web\Controllers\RpcController;
use ZnLib\Web\Symfony4\MicroApp\BaseModule;

class BusModule extends BaseModule
{

    public function configContainer(Container $container)
    {
        //todo: move to domain config "container.php"
        /*$container->bind(ServerRepository::class, function () {
            return new ServerRepository($_ENV['HOST_CONF_DIR'], new HostsRepository());
        }, true);*/
    }

    public function configRoutes(RouteCollection $routes)
    {
        $routes->add('bus_index', new Route('/', [
            '_controller' => DefaultController::class,
            '_action' => 'index',
        ]));
        $routes->add('bus_call_procedure', new Route('/json-rpc', [
            '_controller' => RpcController::class,
            '_action' => 'callProcedure',
        ]));
    }
}
