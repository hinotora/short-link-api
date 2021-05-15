<?php

require_once 'vendor/autoload.php';

// Load environment vars
$env = Dotenv\Dotenv::createMutable('.');
$env->load();

$db_settings = require_once 'config/database.php';

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => $db_settings['DB_DRIVER'],
            'host' => $db_settings['DB_HOST'],
            'name' => $db_settings['DB_NAME'],
            'user' => $db_settings['DB_USER'],
            'pass' => $db_settings['DB_PASS'],
            'port' => $db_settings['DB_PORT'],
            'charset' => 'utf8mb4',
        ],
    ],
    'version_order' => 'creation'
];
