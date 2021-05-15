<?php

use App\Services\Database;

use DI\Container;

return [
    Database::class => function(Container $c) {
        return Database::getConnection();
    },
];
