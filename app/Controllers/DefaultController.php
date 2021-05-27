<?php

namespace App\Controllers;

use Slim\App;
use App\Services\Settings;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class DefaultController
{
    /**
     * Application container implemented by PSR-7.
     *
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * DefaultController constructor.
     * Container injects via PHP-DI.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Redirects from / to default endpoint route selected in routes.
     *
     * @param Response $response
     * @param App $app
     * @return Response
     */
    public function default(Response $response, App $app): Response
    {
        $route = $app->getRouteCollector()->getRouteParser()->urlFor('default-endpoint');

        return $response
            ->withHeader('Location', appUrl($route))
            ->withStatus(302);
    }

    /**
     * Returns information about application.
     *
     * @param Response $response
     * @param Settings $settings
     * @return Response
     */
    public function version(Response $response, Settings $settings): Response
    {
        $settings = $settings->all();

        $payload = [
            'app_name' => $settings['name'],
            'app_url' => $settings['url'],
            'app_env' => $settings['env'],
            'app_ver' => $settings['ver'],

            'services' => [
                'database' => environ('DB_DRIVER'),
                'php' => phpversion(),
            ],
        ];

        $response->withStatus(200);
        $response->getBody()->write(json_encode($payload));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
