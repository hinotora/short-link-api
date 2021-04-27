<?php

$db_settings = require_once 'config/phinx.php';

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => $db_settings['DB_DRIVER'],
            'host' => $db_settings['DB_HOST'],
            'name' => $db_settings['DB_NAME'],
            'user' => $db_settings['DB_USER'],
            'pass' => $db_settings['DB_PASS'],
            'port' => $db_settings['DB_PORT'],
            'charset' => 'utf8mb4',
        ],
        'development' => [
            'adapter' => $db_settings['DB_DRIVER'],
            'host' => $db_settings['DB_HOST'],
            'name' => $db_settings['DB_NAME'],
            'user' => $db_settings['DB_USER'],
            'pass' => $db_settings['DB_PASS'],
            'port' => $db_settings['DB_PORT'],
            'charset' => 'utf8mb4',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'testing_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8mb4',
        ]
    ],
    'version_order' => 'creation'
];
