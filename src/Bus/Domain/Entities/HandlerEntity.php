<?php

namespace App\Bus\Domain\Entities;

class HandlerEntity {

    private $serviceClass;
    private $method;
    private $parameters = [];

    public function getServiceClass(): string
    {
        return $this->serviceClass;
    }

    public function setServiceClass(string $serviceClass): void
    {
        $this->serviceClass = $serviceClass;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }
}
