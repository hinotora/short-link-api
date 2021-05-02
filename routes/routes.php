<?php

use App\Controllers\MainController;
use Slim\App;
use App\Controllers\DefaultController;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->get('/', [DefaultController::class, 'default']);
    $app->group('/v1', function (RouteCollectorProxy $group) {
        $group->get('/', [DefaultController::class, 'default']);
        $group->get('/version', [DefaultController::class, 'version'])->setName('default-endpoint');
        $group->get('/health', [DefaultController::class, 'health']);
        $group->get('/metrics', [DefaultController::class, 'metrics']);
    });

    $app->get('/{link:[a-zA-Z]+$}', [MainController::class, 'redirect']);
};
