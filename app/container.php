<?php

use App\Services\Settings;
use Psr\Container\ContainerInterface;

return [
    Settings::class => function (\DI\Container $c) {
        return Settings::get();
    },
];
