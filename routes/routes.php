<?php

use App\Controllers\MainController;
use App\Middleware\ParseJsonBodyMiddleware;
use Slim\App;
use App\Controllers\DefaultController;
use Slim\Routing\RouteCollectorProxy;

// TODO: SLASH TRAILING

return function (App $app) {

    // Main route, redirects to default-endpoint
    $app->get('/', [DefaultController::class, 'default']);

    // Main link redirect route
    $app->get('/{link:[a-zA-Z]+$}', [MainController::class, 'redirect']);

    // V1 API route
    $app->group('/v1', function (RouteCollectorProxy $group) {

        // Default routes
        $group->get('/', [DefaultController::class, 'default']);
        $group->get('/version', [DefaultController::class, 'version'])->setName('default-endpoint');
        $group->get('/health', [DefaultController::class, 'health']);
        $group->get('/metrics', [DefaultController::class, 'metrics']);

        // Link operations
        $group->group('/link', function (RouteCollectorProxy $group) {

            // TODO: Link CRUD operations
//            $group->put('/');
//            $group->patch('/');
//            $group->delete('/');

        })->addMiddleware(new ParseJsonBodyMiddleware);
    });


};
