<?php

namespace App\Bus\Domain\Services;

use App\Bus\Domain\Repositories\Conf\HostsRepository;
use App\Bus\Domain\Repositories\Conf\ServerRepository;

class ServerService
{

    private $repository;
    private $hostsRepository;

    public function __construct(ServerRepository $repository, HostsRepository $hostsRepository)
    {
        $this->repository = $repository;
        $this->hostsRepository = $hostsRepository;
    }

}
