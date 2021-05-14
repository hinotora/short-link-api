<?php

use Slim\App;

return function (App $app) {
    $env = environ('APP_ENV', 'development');

    $errorMode =  $env == 'development' ? true : false;
    $logErrors = $env == 'testing' ? false : true;

    $app->addErrorMiddleware($errorMode, $logErrors,true);
};