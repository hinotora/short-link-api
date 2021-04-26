<?php

use App\Models\Settings;
use App\Models\Database;
use Psr\Container\ContainerInterface;

return function (ContainerInterface $container) {
    $container->set('app', function () {
        return Settings::get();
    });

    $container->set('database', function () {
        return Database::get();
    });
};
