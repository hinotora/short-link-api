<?php

use Slim\App;

return function (App $app) {
    $settings = $app->getContainer()->get('app');

    $errorMode = $settings['env'] == 'local';

    $app->addErrorMiddleware($errorMode,true,true);
};