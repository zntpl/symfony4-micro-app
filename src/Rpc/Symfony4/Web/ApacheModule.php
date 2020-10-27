<?php

namespace App\Rpc\Symfony4\Web;

use Illuminate\Container\Container;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Rpc\Domain\Repositories\Conf\HostsRepository;
use App\Rpc\Domain\Repositories\Conf\ServerRepository;
use App\Rpc\Symfony4\Web\Controllers\ServerController;
use ZnLib\Web\Symfony4\MicroApp\BaseModule;

class ApacheModule extends BaseModule
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
        $routes->add('server_index', new Route('/', [
            '_controller' => ServerController::class,
            '_action' => 'index',
        ]));
        $routes->add('server_view', new Route('/view', [
            '_controller' => ServerController::class,
            '_action' => 'view',
        ]));
    }
}
