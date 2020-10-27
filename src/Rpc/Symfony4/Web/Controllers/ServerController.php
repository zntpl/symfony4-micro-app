<?php

namespace App\Rpc\Symfony4\Web\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ZnLib\Web\Symfony4\MicroApp\BaseWebController;
use App\Rpc\Domain\Services\ServerService;

class ServerController extends BaseWebController
{

    protected $viewsDir = __DIR__ . '/../views/server';

    private $serverService;

    public function __construct(
        ServerService $serverService
    )
    {
        $this->serverService = $serverService;
    }

    public function index(Request $request): Response
    {
        $links = $this->serverService->all();
        return $this->renderTemplate('index', [
            'links' => $links,
        ]);
    }

    public function view(Request $request, string $name): Response
    {
        $entity = $this->serverService->oneByName($name);
        return $this->renderTemplate('view', [
            'entity' => $entity,
        ]);
    }

}
