<?php

use App\Controllers\MainController;
use Slim\App;
use App\Controllers\DefaultController;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->get('/', [DefaultController::class, 'redirect_main']);

    $app->get('/{link}', [MainController::class, 'redirect']);

    $app->group('/v1', function (RouteCollectorProxy $group) {
        $group->get('/', [DefaultController::class, 'redirect_main']);
        $group->get('/version', [DefaultController::class, 'version'])->setName('default-endpoint');
        $group->get('/health', [DefaultController::class, 'health']);
        $group->get('/metrics', [DefaultController::class, 'metrics']);


    });
};
