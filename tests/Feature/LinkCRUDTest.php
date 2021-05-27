<?php

namespace Tests\Feature;

use Tests\TestCase;

class LinkCRUDTest extends TestCase
{
    static string $templink;

    public function test_new_link()
    {
        $request = $this->createRequest('PUT', '/v1/link', [
            'HTTP_ACCEPT' => 'application/json',
        ]);
        $request = $request->withParsedBody(['link'=>'https://www.ya.ru/']);
        $response = $this->app->handle($request);

        $jsonDecoded = json_decode((string) $response->getBody(), true);
        self::$templink = explode('/', $jsonDecoded['short'])[3];

        $this->assertSame(201, $response->getStatusCode());
        $this->assertArrayHasKey('short', $jsonDecoded);
        $this->assertArrayHasKey('full_link', $jsonDecoded);
        $this->assertArrayHasKey('created_at', $jsonDecoded);
        $this->assertArrayHasKey('redirects_count', $jsonDecoded);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
    }

    public function test_known_link_information()
    {
        $request = $this->createRequest('GET', "/v1/link/".self::$templink);
        $response = $this->app->handle($request);
        $jsonDecoded = json_decode((string) $response->getBody(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertArrayHasKey('short', $jsonDecoded);
        $this->assertArrayHasKey('full_link', $jsonDecoded);
        $this->assertArrayHasKey('created_at', $jsonDecoded);
        $this->assertArrayHasKey('redirects_count', $jsonDecoded);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
    }

    public function test_remove_link()
    {
        $request = $this->createRequest('DELETE', "/v1/link/".self::$templink);
        $response = $this->app->handle($request);
        $jsonDecoded = json_decode((string) $response->getBody(), true);

        $this->assertSame(204, $response->getStatusCode());
        $this->assertSame(null, $jsonDecoded);
    }

    public function test_unknown_link_information()
    {
        $request = $this->createRequest('GET', "/v1/link/".self::$templink);
        $response = $this->app->handle($request);

        $this->assertSame(404, $response->getStatusCode());
    }

    public function test_json_parse_middleware()
    {
        $request = $this->createRequest('PUT', '/v1/link', [
            'HTTP_ACCEPT' => 'application/json',
            'CONTENT_TYPE' => 'application/json',
        ]);
        $response = $this->app->handle($request);

        $this->assertSame(400, $response->getStatusCode());
    }

    public function test_new_link_fail()
    {
        $request = $this->createRequest('PUT', '/v1/link', [
            'HTTP_ACCEPT' => 'application/json',
        ]);
        $request = $request->withParsedBody(['unknown_key'=>'https://www.ya.ru/']);
        $response = $this->app->handle($request);

        $this->assertSame(400, $response->getStatusCode());
    }

    public function test_delete_link_fail()
    {
        $request = $this->createRequest('DELETE', '/v1/link/unknown', [
            'HTTP_ACCEPT' => 'application/json',
        ]);
        $response = $this->app->handle($request);

        $this->assertSame(404, $response->getStatusCode());
    }

    public function test_new_invalid_link()
    {
        $request = $this->createRequest('PUT', '/v1/link', [
            'HTTP_ACCEPT' => 'application/json',
        ]);
        $request = $request->withParsedBody(['link'=>'htts:/www ya.ru/']);
        $response = $this->app->handle($request);

        $this->assertSame(400, $response->getStatusCode());
    }
}