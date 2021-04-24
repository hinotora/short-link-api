<?php

declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));
define('APP_START', microtime(true));

// Require dependencies
require_once BASE_PATH . '/vendor/autoload.php';

// Require bootstrap file
require_once BASE_PATH . '/app/bootstrap.php';
