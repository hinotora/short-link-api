<?php

use App\Services\Settings;
use Slim\App;

return function (App $app) {
    $env = environ('APP_ENV', 'testing');

    if ($env == 'development') {
        $errorMode = true;
    } else if ($env == 'testing') {
        $errorMode = true;
    } else {
        $errorMode = false;
    }

    $app->addErrorMiddleware($errorMode,true,true);
};