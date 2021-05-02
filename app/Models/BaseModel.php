<?php

namespace App\Models;

use App\Services\Database;
use Psr\Container\ContainerInterface;

abstract class BaseModel
{
    protected ContainerInterface $container;
    protected \PDO $pdo;

    protected int $idModel;
    protected string $table;
    protected string $primaryKey;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->pdo = $this->container->get(Database::class);
    }

    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->getTableName()}");

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    protected function getTableName(): string
    {
        return $this->table;
    }

    protected function getPrimaryKeyColumn(): string
    {
        return $this->primaryKey;
    }

    protected function getModelId(): int
    {
        return $this->idModel;
    }

    protected function setModelId(int $id): void
    {
        $this->idModel = $id;
    }
}