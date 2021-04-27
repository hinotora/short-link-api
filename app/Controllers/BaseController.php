<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;

abstract class BaseController
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}