<?php

use App\Services\Settings;
use Slim\App;

return function (App $app) {
    $env = $app->getContainer()->get(Settings::class)->key('env');

    $errorMode = ($env == 'development');

    $app->addErrorMiddleware($errorMode,true,true);
};