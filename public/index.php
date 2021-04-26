<?php

// Using strict types
declare(strict_types=1);

// Define some global vars
define('APP_START', microtime(true));
define('BASE_PATH', dirname(__DIR__));

// Require dependencies
require_once BASE_PATH . '/vendor/autoload.php';

// Require bootstrap file
require_once BASE_PATH . '/app/bootstrap.php';
