<?php

namespace App\Rpc\Symfony4\Web\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ZnLib\Web\Symfony4\MicroApp\BaseWebController;
use App\Rpc\Domain\Services\ServerService;

class FrontController extends BaseWebController
{

    protected $viewsDir = __DIR__ . '/../views/front';

    private $serverService;

    public function __construct(
        ServerService $serverService
    )
    {
        $this->serverService = $serverService;
    }

    public function index(Request $request): Response
    {
        //$links = $this->serverService->all();
        return $this->renderTemplate('index', [
            //'links' => $links,
        ]);
    }

    public function view(Request $request): Response
    {
        dd('Hello world!!!');
        //$entity = $this->serverService->oneByName($name);
        return $this->renderTemplate('view', [
            //'entity' => $entity,
        ]);
    }

}
