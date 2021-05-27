<?php

namespace App\Controllers;

use App\Models\Link;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;

class MainController
{
    /**
     * Contains Link model.
     *
     * @var Link
     */
    private Link $link;

    /**
     * LinkController constructor.
     * Link model injects via PHP-DI.
     *
     * @param Link $link
     */
    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    /**
     * Main redirect endpoint. Searches short link in database and redirects user.
     *
     * @param Response $response
     * @param Request $request
     * @param string $link
     * @return Response
     * @throws HttpNotFoundException
     */
    public function redirect(Response $response, Request $request, string $link): Response
    {
        if (!$this->link->find($link)) {
            throw new HttpNotFoundException($request, "Given link not found in database ($link)");
        }

        return $response->withHeader("Location", $this->link->incrementRedirect()->getUrl())->withStatus(302);
    }
}
