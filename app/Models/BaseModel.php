<?php

namespace App\Models;

use App\Services\Database;
use DI\Container;

abstract class BaseModel
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}