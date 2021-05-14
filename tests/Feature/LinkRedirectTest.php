<?php

namespace Tests\Feature;

use Tests\TestCase;

class LinkRedirectTest extends TestCase
{
    public function test_known_link_redirect()
    {
        $request = $this->createRequest('GET', '/somelinkfromdbseeder');
        $response = $this->app->handle($request);

        $this->assertSame(302, $response->getStatusCode());
        $this->assertSame('https://google.com/', $response->getHeaderLine('Location'));
    }

    public function test_unknown_link_redirect()
    {
        $request = $this->createRequest('GET', '/unknownlink');
        $response = $this->app->handle($request);

        $this->assertSame(404, $response->getStatusCode());
    }
}