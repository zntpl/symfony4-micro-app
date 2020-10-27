<?php

namespace App\Bus\Domain\Services;

class TestService
{

    public function testMethod(int $id)
    {
        return [
            'id' => $id,
            'name' => 'qwerty' . $id,
        ];
    }
}
