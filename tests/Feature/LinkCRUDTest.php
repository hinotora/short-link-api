<?php

namespace Tests\Feature;

use Tests\TestCase;

class LinkCRUDTest extends TestCase
{
    protected string $templink;

    public function test_known_link_information()
    {
        $request = $this->createRequest('GET', '/v1/link/somelinkfromdbseeder');
        $response = $this->app->handle($request);
        $jsonDecoded = json_decode((string) $response->getBody(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertArrayHasKey('short', $jsonDecoded);
        $this->assertArrayHasKey('full', $jsonDecoded);
        $this->assertArrayHasKey('created_at', $jsonDecoded);
        $this->assertArrayHasKey('redirects_count', $jsonDecoded);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
    }
}