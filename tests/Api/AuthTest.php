<?php

namespace Tests\Api;

use ZnCore\Base\Enums\Http\HttpStatusCodeEnum;
use ZnTool\Test\Base\BaseRestApiTest;

class AuthTest extends BaseRestApiTest
{

    protected $basePath = '';

    public function testUnauthorized()
    {
        $this->assertEquals(1,1);
        $response = $this->getRestClient()->sendPost('', [
            'data' => '{"method":"testMethod","parameters":{"id":"111"}}',
        ]);

        $this->getRestAssert($response)
            ->assertStatusCode(HttpStatusCodeEnum::OK);
    }

    /*public function testAuthorized()
    {
        $client = $this->getRestClient();
        $client->getAuthAgent()->authByLogin('admin');
        $response = $client->sendGet('auth');
        $this->getRestAssert($response)
            ->assertStatusCode(HttpStatusCodeEnum::OK);
    }

    public function testAuth()
    {
        $response = $this->getRestClient()->sendPost('auth', [
            'login' => 'admin',
            'password' => 'Wwwqqq111',
        ]);

        $assert = $this->getRestAssert($response);
        $assert
            ->assertStatusCode(HttpStatusCodeEnum::NO_CONTENT);

        // check
        $token = $response->getHeader(HttpHeaderEnum::AUTHORIZATION)[0];
        $this->checkAuth($token, 'admin');
    }

    private function checkAuth(string $token, string $login) {
        $client = $this->getRestClient();
        $options[RequestOptions::HEADERS][HttpHeaderEnum::AUTHORIZATION] = $token;
        $response = $client->sendRequest(HttpMethodEnum::GET, 'auth', $options);
        $expectedBody = [
            'login' => $login,
            'status' => 1,
        ];
        $this->getRestAssert($response)
            ->assertStatusCode(HttpStatusCodeEnum::OK)
            ->assertBody($expectedBody);
    }

    public function testAuthBadPassword()
    {
        $response = $this->getRestClient()->sendPost('auth', [
            'login' => 'admin',
            'password' => 'Wwwqqq11133333',
        ]);

        $this->getRestAssert($response)
            ->assertUnprocessableEntity(['password']);
    }*/

}
