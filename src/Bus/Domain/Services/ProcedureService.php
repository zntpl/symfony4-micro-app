<?php

namespace App\Bus\Domain\Services;

use App\Bus\Domain\Entities\HandlerEntity;
use App\Bus\Domain\Repositories\Conf\ProcedureConfigRepository;
use Illuminate\Container\Container;
use ZnCore\Base\Exceptions\NotFoundException;
use ZnCore\Domain\Exceptions\UnprocessibleEntityException;
use ZnCore\Domain\Helpers\ValidationHelper;
use Exception;

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
        try {
            $handler = $this->procedureConfigRepository->getHandlerByName($procedureName);
            $result = $this->runProcedure($handler, $params);
        } catch (UnprocessibleEntityException $e) {
            $result = [
                'error' => 'UnprocessibleEntityException',
                'code' => $e->getCode(),
                'message' => ValidationHelper::collectionToArray($e->getErrorCollection()),
            ];
        } catch (Exception $e) {
            $result = [
                'error' => basename(get_class($e)),
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
        return $result;
    }

    /**
     * @param HandlerEntity $handlerEntity
     * @param array $params
     * @return mixed
     * @throws NotFoundException
     * @throws UnprocessibleEntityException
     */
    private function runProcedure(HandlerEntity $handlerEntity, array $params)
    {
        $serviceInstance = $this->container->get($handlerEntity->getServiceClass());
        if( ! method_exists($serviceInstance, $handlerEntity->getMethod())) {
            throw new NotFoundException('Not found method');
        }
        $this->validateParameters($handlerEntity, $params);
        return $this->container->call([$serviceInstance, $handlerEntity->getMethod()], $params);
    }

    /**
     * @param HandlerEntity $handlerEntity
     * @param array $params
     * @throws UnprocessibleEntityException
     */
    private function validateParameters(HandlerEntity $handlerEntity, array $params) {
        $errorCollection = ValidationHelper::validate($handlerEntity->getParameters(), (object) $params);
        if ($errorCollection->count() > 0) {
            $exception = new UnprocessibleEntityException;
            $exception->setErrorCollection($errorCollection);
            throw $exception;
        }
    }
}
