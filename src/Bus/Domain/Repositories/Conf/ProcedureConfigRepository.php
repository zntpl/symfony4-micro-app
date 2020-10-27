<?php

namespace App\Bus\Domain\Repositories\Conf;

use App\Bus\Domain\Entities\HandlerEntity;
use App\Bus\Domain\Services\TestService;
use ZnCore\Base\Legacy\Yii\Helpers\ArrayHelper;
use ZnCore\Domain\Helpers\EntityHelper;

class ProcedureConfigRepository
{

    public function getHandlerByName(string $name): HandlerEntity
    {
        $procedureMap = [
            'testMethod' => [
                'serviceClass' => TestService::class,
                'method' => 'testMethod',
            ],
        ];
        $handler = ArrayHelper::getValue($procedureMap, $name);
        if (!$handler) {
            $handler = ArrayHelper::getValue($procedureMap, 'default');
        }
        return EntityHelper::createEntity(HandlerEntity::class, $handler);
    }
}
