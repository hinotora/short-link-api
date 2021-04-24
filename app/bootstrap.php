<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;


$env = Dotenv::createMutable(BASE_PATH);
$env->load();

$app = AppFactory::create();

require_once BASE_PATH . '/routes/api.php';

$app->run();
