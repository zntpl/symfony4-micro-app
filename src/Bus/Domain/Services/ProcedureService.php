<?php

namespace App\Bus\Domain\Services;

use Illuminate\Container\Container;
use ZnCore\Base\Legacy\Yii\Helpers\ArrayHelper;

class ProcedureService
{

    private $container;

    public function __construct(
        Container $container
    )
    {
        $this->container = $container;
    }

    public function run(string $procedureName, array $params) {
        $handler = $this->getHandler($procedureName);
        return $this->runProcedure($handler, $params);
    }

    private function runProcedure(array $handler, array $params) {
        $serviceInstance = $this->container->get($handler['serviceClass']);
        return $this->container->call([$serviceInstance, $handler['method']], $params);
    }

    private function getHandler(string $name): array {
        $procedureMap = [
            'testMethod' => [
                'serviceClass' => TestService::class,
                'method' => 'testMethod',
            ],
        ];
        $handler = ArrayHelper::getValue($procedureMap, $name);
        if( ! $handler) {
            $handler = ArrayHelper::getValue($procedureMap, 'default');
        }
        return $handler;
    }
}
