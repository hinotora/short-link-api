<?php

namespace App\Controllers;

use App\Models\Link;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;

class MainController
{
    private Link $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function redirect(Response $response, Request $request, string $link): Response
    {
        if (!$this->link->find($link)) {
            throw new HttpNotFoundException($request, "Given link not found in database ($link)");
        }

        return $response->withHeader("Location", $this->link->incrementRedirect()->getUrl())->withStatus(302);
    }
}
