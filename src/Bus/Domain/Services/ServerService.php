<?php

namespace App\Bus\Domain\Services;

use App\Bus\Domain\Repositories\Conf\ProcedureConfigRepository;
use App\Bus\Domain\Repositories\Conf\ServerRepository;

class ServerService
{

    private $repository;
    private $hostsRepository;

    public function __construct(ServerRepository $repository, ProcedureConfigRepository $hostsRepository)
    {
        $this->repository = $repository;
        $this->hostsRepository = $hostsRepository;
    }

}
