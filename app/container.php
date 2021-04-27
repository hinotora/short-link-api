<?php

use App\Services\Database;
use App\Services\Settings;

return [
    Settings::class => function (\DI\Container $c) {
        return Settings::get();
    },

    Database::class => function(\DI\Container $e) {
        return Database::getConnection();
    },
];
