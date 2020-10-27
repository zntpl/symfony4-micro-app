<?php

namespace App\Bus\Domain\Services;

use App\Bus\Domain\Entities\HandlerEntity;
use Illuminate\Container\Container;
use ZnCore\Base\Legacy\Yii\Helpers\ArrayHelper;
use ZnCore\Domain\Helpers\EntityHelper;

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

    private function runProcedure(HandlerEntity $handlerEntity, array $params) {
        $serviceInstance = $this->container->get($handlerEntity->getServiceClass());
        return $this->container->call([$serviceInstance, $handlerEntity->getMethod()], $params);
    }

    private function getHandler(string $name): HandlerEntity {
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
        return EntityHelper::createEntity(HandlerEntity::class, $handler);
    }
}
