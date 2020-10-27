<?php

namespace App\Bus\Symfony4\Web\Controllers;

use App\Bus\Domain\Services\ProcedureService;
use Illuminate\Container\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ZnCore\Base\Enums\Http\HttpHeaderEnum;
use ZnCore\Base\Legacy\Yii\Helpers\ArrayHelper;

class RpcController
{

    private $procedureService;
    private $container;

    public function __construct(
        Container $container,
        ProcedureService $procedureService
    )
    {
        $this->container = $container;
        $this->procedureService = $procedureService;
    }

    public function callProcedure(Request $request): Response
    {
        $response = new JsonResponse();
//        $response->headers->set(HttpHeaderEnum::CONTENT_TYPE, 'application/json');
        $data = json_decode($_POST['data'], JSON_OBJECT_AS_ARRAY);
        $procedureName = $data['method'];
        $parameters = ArrayHelper::getValue($data, 'parameters', []);
        $result = $this->procedureService->run($procedureName, $parameters);
        $response->setData($result);
        return $response;
    }
}
