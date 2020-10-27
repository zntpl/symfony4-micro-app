<?php

namespace App\Bus\Symfony4\Web\Controllers;

use App\Bus\Domain\Services\TestService;
use http\Encoding\Stream\Inflate;
use Illuminate\Container\Container;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Bus\Domain\Services\ServerService;
use ZnCore\Base\Legacy\Yii\Helpers\ArrayHelper;

class RpcController
{

    private $serverService;
    private $container;

    public function __construct(
        Container $container,
        ServerService $serverService
    )
    {
        $this->container = $container;
        $this->serverService = $serverService;
    }

    public function callProcedure(Request $request): Response
    {
        $response = new JsonResponse();
        $data = json_decode($_POST['data'], JSON_OBJECT_AS_ARRAY);
        $procedureName = $data['method'];
        $params = ArrayHelper::getValue($data, 'params', []);
        $handler = $this->getHandler($procedureName);
        $result = $this->runProcedure($handler, $params);
        /*$response->setData([
            'request' => $data,
            'response' => $result,
        ]);*/
        $response->setData($result);
        return $response;
    }

    private function runProcedure(array $handler, array $params) {
        $serviceInstance = $this->container->get($handler['serviceClass']);
        $result = $this->container->call([$serviceInstance, $handler['method']], $params);
        return $result;
    }

    private function getHandler(string $name): array {
        $procedureMap = [
            'testMethod' => [
                'serviceClass' => TestService::class,
                'method' => 'testMethod',
            ],
        ];
        $handler = $procedureMap[$name];
        return $handler;
    }
}
