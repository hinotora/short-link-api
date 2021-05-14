<?php

declare(strict_types=1);

use App\Middleware\SlashTrainingMiddleware;
use DI\Bridge\Slim\Bridge as AppFactory;
use DI\ContainerBuilder;
use Dotenv\Dotenv;


// Require dependencies
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Load environment vars
if ($_ENV['APP_ENV'] == 'testing')
    $env = Dotenv::createMutable(dirname(__DIR__),'.env.testing');
else
    $env = Dotenv::createMutable(dirname(__DIR__));

$env->load();

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ . '/../app/container.php');
$container = $builder->build();

$app = AppFactory::create($container);

// Initialize middleware
$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

// Initialize API routes
$routes = require __DIR__ . '/../routes/routes.php';
$routes($app);

// Initialize other middleware
$app->add(new SlashTrainingMiddleware());

return $app;
