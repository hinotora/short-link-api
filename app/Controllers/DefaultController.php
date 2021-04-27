<?php

namespace App\Controllers;

use App\Services\Settings;
use Psr\Http\Message\ResponseInterface as Response;

class DefaultController
{
    public function home(Response $response): Response
    {
        return $response
            ->withHeader('Location', '/version')
            ->withStatus(302);
    }

    public function version(Response $response, Settings $settings): Response
    {
        $settings = $settings->all();

        $data = [
            'app_name' => $settings['name'],
            'app_url' => $settings['url'],
            'app_env' => $settings['env'],
            'app_ver' => $settings['ver'],
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

        $response->getBody()->write(json_encode($data));
        $response->withStatus(200);

        return $response;
    }
}
