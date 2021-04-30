<?php

namespace App\Models;

use App\Services\Database;
use Psr\Container\ContainerInterface;

abstract class BaseModel
{
    protected ContainerInterface $container;
    protected \PDO $pdo;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->pdo = $this->container->get(Database::class);
    }
}