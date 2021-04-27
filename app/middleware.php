<?php

use App\Services\SettingsInterface;
use Slim\App;

return function (App $app) {
    $env = $app->getContainer()->get(SettingsInterface::class)->key('env');

    $errorMode = $env == 'local' ? true: false;

    $app->addErrorMiddleware($errorMode,true,true);
};