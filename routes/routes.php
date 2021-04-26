<?php

use Slim\App;
use App\Controllers\DefaultController;

return function (App $app) {
    // Default routes
    $app->get('/', [DefaultController::class, 'home']);
    $app->get('/version', [DefaultController::class, 'version']);
    $app->get('/health', [DefaultController::class, 'health']);
    $app->get('/metrics', [DefaultController::class, 'metrics']);

    // Auth routes
};
