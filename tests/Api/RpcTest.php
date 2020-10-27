<?php

namespace Tests\Api;

use ZnCore\Base\Enums\Http\HttpStatusCodeEnum;
use ZnTool\Test\Base\BaseRestApiTest;

class RpcTest extends BaseRestApiTest
{

//    protected $basePath = 'json-rpc';

    public function testExample()
    {
        $response = $this->getRestClient()->sendPost('/json-rpc', [
            'data' => '{"method":"testMethod","parameters":{"id":"111"}}',
        ]);

        $this->getRestAssert($response)
            ->assertBody([
                "id" => 111,
                "name" => "qwerty111"
            ])
            ->assertStatusCode(HttpStatusCodeEnum::OK);
    }

    public function testNotFoundMethod()
    {
        $response = $this->getRestClient()->sendPost('/json-rpc', [
            'data' => '{"method":"testMethod11111111111","parameters":{"id":"111"}}',
        ]);

        $this->getRestAssert($response)
            ->assertBody([
                "error" => "ZnCore\\Base\\Exceptions\\NotFoundException",
                "code" => 0,
                "message" => "Not found handler",
            ])
            ->assertStatusCode(HttpStatusCodeEnum::OK);
    }

    public function testBadParameters()
    {
        $response = $this->getRestClient()->sendPost('/json-rpc', [
            'data' => '{"method":"testMethod","parameters":{"id":"qqqqqq"}}',
        ]);

        $this->getRestAssert($response)
            ->assertBody([
                "error" => "UnprocessibleEntityException",
                "code" => 0,
                "message" => "Parameters not valid",
                "errorCollection" => [
                    [
                        "field" => "id",
                        "message" => "This value should be positive."
                    ]
                ]
            ])
            ->assertStatusCode(HttpStatusCodeEnum::OK);
    }

}
