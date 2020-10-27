<?php

namespace App\Bus\Symfony4\Web\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Bus\Domain\Services\ServerService;

class RpcController
{

    private $serverService;

    public function __construct(
        ServerService $serverService
    )
    {
        $this->serverService = $serverService;
    }

    public function jsonExample(Request $request): Response
    {
        $response = new JsonResponse();
        $response->setData([
            'name' => 'code'
        ]);
        return $response;
    }
}
