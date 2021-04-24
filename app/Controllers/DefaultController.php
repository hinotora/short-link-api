<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DefaultController
{
    public function version(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $response->getBody()->write('1.0.0');

        return $response;
    }

    public function health(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $response->getStatusCode(200);

        return $response;
    }

    public function metrics(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $time = microtime(true) - APP_START;

        $response->getBody()->write(json_encode(["time" => $time]));

        return $response;
    }
}
