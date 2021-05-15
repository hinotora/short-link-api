<?php

namespace App\Controllers;

use App\Models\Link;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
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

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function create(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $body =  $request->getParsedBody();

        if (!isset($body['link'])) {
            throw new HttpBadRequestException($request, "Empty request body (no json given).");
        }

        $newLink = $body['link'];

        if (!parseUrl($newLink)) {
            throw new HttpBadRequestException($request, "Given url is not valid url.");
        }

        if (!$this->link->store($newLink)) {
            throw new HttpInternalServerErrorException($request, "Error while inserting model into database.");
        }

        $payload = $this->link->info();

        $response->getBody()->write(json_encode($payload));

        return $response->withStatus(201)->withHeader('Content-Type', 'application/json');

    }

    public function delete(ServerRequestInterface $request, ResponseInterface $response, string $link): ResponseInterface
    {
        if (!$this->link->find($link)) {
            throw new HttpNotFoundException($request, "Given link not found in database ($link)");
        }

        if (!$this->link->delete()) {
            throw new HttpInternalServerErrorException($request, "Error while deleting model from database.");
        }

        return $response->withStatus(204);
    }
}