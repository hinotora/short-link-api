<?php

use App\Services\Database;
use App\Services\Settings;

use DI\Container;

return [
    Settings::class => function (Container $c) {
        return Settings::instance();
    },

    Database::class => function(Container $c) {
        return Database::getConnection();
    },
];
