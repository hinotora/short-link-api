<?php

namespace Tests\Feature;

use Tests\TestCase;

class DefaultEndpointsTest extends TestCase
{
    public function test_home_endpoint()
    {
        $request = $this->createRequest('GET', '/');
        $response = $this->app->handle($request);

        $this->assertSame(302, $response->getStatusCode());
        $this->assertSame(appUrl('/v1/version'), $response->getHeaderLine('Location'));
    }

    public function test_slash_trailing()
    {
        $request = $this->createRequest('GET', '/v1/');
        $response = $this->app->handle($request);

        $this->assertSame(301, $response->getStatusCode());
    }

    public function test_v1_home_endpoint()
    {
        $request = $this->createRequest('GET', '/v1');
        $response = $this->app->handle($request);

        $this->assertSame(302, $response->getStatusCode());
        $this->assertSame(appUrl('/v1/version'), $response->getHeaderLine('Location'));
    }

    public function test_version_endpoint()
    {
        $request = $this->createRequest('GET', '/v1/version');
        $response = $this->app->handle($request);
        $jsonDecoded = json_decode((string) $response->getBody(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertArrayHasKey('app_name', $jsonDecoded);
        $this->assertArrayHasKey('app_url', $jsonDecoded);
        $this->assertArrayHasKey('app_env', $jsonDecoded);
        $this->assertArrayHasKey('app_ver', $jsonDecoded);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
    }
}