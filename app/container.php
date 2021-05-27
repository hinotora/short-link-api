<?php

use App\Services\Database;

use DI\Container;

/**
 * Returns container definitions.
 */
return [
    Database::class => function(Container $c) {
        return Database::getConnection();
    },
];
