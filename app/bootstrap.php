<?php

use DI\Bridge\Slim\Bridge as AppFactory;
use DI\ContainerBuilder;
use Dotenv\Dotenv;

// Load environment vars
$env = Dotenv::createMutable(BASE_PATH);
$env->load();

$builder = new ContainerBuilder();
$builder->addDefinitions(BASE_PATH . '/app/container.php');
$container = $builder->build();

$app = AppFactory::create($container);

// Initialize middleware
$middleware = require_once BASE_PATH . '/app/middleware.php';
$middleware($app);

// Initialize API routes
$routes = require_once BASE_PATH . '/routes/routes.php';
$routes($app);

$app->run();
