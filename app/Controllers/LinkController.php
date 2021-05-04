<?php

namespace App\Controllers;

use App\Models\Link;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpNotFoundException;

class LinkController
{
    private Link $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function show(ServerRequestInterface $request, ResponseInterface $response, string $link): ResponseInterface
    {
        if (!$this->link->find($link)) {
            throw new HttpNotFoundException($request, "LINK NOT FOUND > $link");
        }

        $payload = $this->link->info();

        $response->getBody()->write(json_encode($payload));

        return $response;
    }

    public function create(ServerRequestInterface $request, ResponseInterface $response, App $app): ResponseInterface
    {
        $newLink = $request->getParsedBody()['full'];

        if (!parseUrl($newLink)) {
            throw new HttpBadRequestException($request, "URL IS NOT VALID");
        }

        if (!$this->link->store($newLink)) {
            throw new HttpInternalServerErrorException($request, "INSERT FAIL");
        }

        $payload = $this->link->info();

        $response->getBody()->write(json_encode($payload));

        return $response->withStatus(201);

    }

    public function delete(ServerRequestInterface $request, ResponseInterface $response, string $link): ResponseInterface
    {
        if (!$this->link->find($link)) {
            throw new HttpNotFoundException($request, "LINK NOT FOUND > $link");
        }

        if (!$this->link->delete()) {
            throw new HttpInternalServerErrorException($request, "DELETE FAIL");
        }

        return $response->withStatus(204);
    }
}