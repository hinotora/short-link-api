<?php

namespace App\Controllers;

use Slim\App;
use App\Services\Settings;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;


class DefaultController
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function default(Response $response): Response
    {
        $app = $this->container->get(App::class);
        $route = $app->getRouteCollector()->getRouteParser()->urlFor('default-endpoint');

        return $response
            ->withHeader('Location', $route)
            ->withStatus(302);
    }

    public function version(Response $response): Response
    {
        $settings = $this->container->get(Settings::class);

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
