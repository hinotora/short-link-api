<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpBadRequestException;

class ParseJsonBodyMiddleware implements MiddlewareInterface
{
    /**
     * Parsing middleware which validate json body if header Content-Type is exist.
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws HttpBadRequestException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $acceptType = $request->getHeaderLine('Content-Type');

        if(strstr($acceptType, 'application/json')) {
            $contents = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $request = $request->withParsedBody($contents);
            } else {
                throw new HttpBadRequestException($request, 'Given json is not valid (Parse error).');
            }
        }

        return $handler->handle($request);
    }
}