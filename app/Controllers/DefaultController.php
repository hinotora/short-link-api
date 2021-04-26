<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\Settings;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DefaultController
{
    public function home(Response $response): Response
    {
        return $response
            ->withHeader('Location', '/version')
            ->withStatus(302);
    }

    public function version(Response $response): Response
    {
        $data = [
            'app_name' => Settings::get('name'),
            'app_url' => Settings::get('url'),
            'app_env' => Settings::get('env'),
            'app_ver' => Settings::get('ver'),
        ];

        $response->withStatus(200);
        $response->getBody()->write(json_encode($data));

        return $response;
    }

    public function health(Response $response): Response
    {
        $response->withStatus(200);

        return $response;
    }

    public function metrics(Response $response): Response
    {
        $time = microtime(true) - APP_START;

        $data = [
            'request_time' => $time,
        ];

        $data['some_data_from_db'] = 123;

        $response->getBody()->write(json_encode($data));
        $response->withStatus(200);

        return $response;
    }
}
