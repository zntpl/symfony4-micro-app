<?php

namespace App\Bus\Domain\Services;

use App\Bus\Domain\Entities\HandlerEntity;
use App\Bus\Domain\Repositories\Conf\ProcedureConfigRepository;
use Illuminate\Container\Container;

class ProcedureService
{

    private $container;
    private $procedureConfigRepository;

    public function __construct(
        Container $container,
        ProcedureConfigRepository $procedureConfigRepository
    )
    {
        $this->container = $container;
        $this->procedureConfigRepository = $procedureConfigRepository;
    }

    public function run(string $procedureName, array $params)
    {
        $handler = $this->procedureConfigRepository->getHandlerByName($procedureName);
        //$handler = $this->getHandler($procedureName);
        return $this->runProcedure($handler, $params);
    }

    private function runProcedure(HandlerEntity $handlerEntity, array $params)
    {
        $serviceInstance = $this->container->get($handlerEntity->getServiceClass());
        return $this->container->call([$serviceInstance, $handlerEntity->getMethod()], $params);
    }
}
