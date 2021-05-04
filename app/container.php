<?php

use App\Services\Database;
use App\Services\Settings;

use DI\Container;

return [
    Database::class => function(Container $c) {
        return Database::getConnection();
    },
];
