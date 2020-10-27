<?php

use App\Bus\Domain\Services\TestService;
use Symfony\Component\Validator\Constraints as Assert;

return [
    'testMethod' => [
        'serviceClass' => TestService::class,
        'method' => 'testMethod',
        'parameters' => [
            'id' => [
                new Assert\NotBlank(),
                new Assert\Positive(),
            ],
        ],
    ],
];
