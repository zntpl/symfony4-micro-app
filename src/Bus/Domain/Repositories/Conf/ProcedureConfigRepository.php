<?php

namespace App\Bus\Domain\Repositories\Conf;

use App\Bus\Domain\Entities\HandlerEntity;
use ZnCore\Base\Exceptions\NotFoundException;
use ZnCore\Base\Legacy\Yii\Helpers\ArrayHelper;
use ZnCore\Domain\Helpers\EntityHelper;

class ProcedureConfigRepository
{

    public function getHandlerByName(string $name): HandlerEntity
    {
        $procedureMap = include __DIR__ . '/../../../../../config/bus.php';
        $handler = ArrayHelper::getValue($procedureMap, $name);
        if (!$handler) {
            throw new NotFoundException('Not found handler');
//            $handler = ArrayHelper::getValue($procedureMap, 'default');
        }
        return EntityHelper::createEntity(HandlerEntity::class, $handler);
    }
}
