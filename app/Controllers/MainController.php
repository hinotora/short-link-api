<?php

namespace App\Controllers;

use App\Models\Link;
use Psr\Http\Message\ResponseInterface as Response;

class MainController
{
    private Link $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function redirect(Response $response, $link): Response
    {
        $response->getBody()->write($this->link->get());

        return $response;
    }
}
