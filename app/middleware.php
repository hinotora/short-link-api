<?php

use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

return function (App $app) {
    $env = $app->getContainer()->get(\App\Services\Settings::class)->key('env');

    $errorMode = $env == 'local' ? true: false;

    $app->addErrorMiddleware($errorMode,true,true);
};