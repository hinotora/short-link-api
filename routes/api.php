<?php

use App\Controllers\DefaultController;


// Default routes
$app->get('/version', DefaultController::class . ':version');
$app->get('/health', DefaultController::class . ':health');
$app->get('/metrics', DefaultController::class . ':metrics');
