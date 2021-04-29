<?php

use App\Services\SettingsInterface;
use Slim\App;

return function (App $app) {
    $env = $app->getContainer()->get(SettingsInterface::class)->key('env');

    $errorMode = ($env == 'development');

    $app->addErrorMiddleware($errorMode,true,true);
};