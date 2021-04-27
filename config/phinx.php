<?php

require_once 'vendor/autoload.php';

// Load environment vars
$env = Dotenv\Dotenv::createMutable('.');
$env->load();

return require_once 'config/database.php';
