<?php

use App\Services\Database;
use App\Services\Settings;
use App\Services\SettingsInterface;

use DI\Container;

return [
    SettingsInterface::class => function (Container $c) {
        return Settings::instance();
    },

    Database::class => function(Container $c) {
        return Database::getConnection();
    },
];
