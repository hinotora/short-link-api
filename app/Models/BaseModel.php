<?php

namespace App\Models;

use App\Services\Database;
use Psr\Container\ContainerInterface;

abstract class BaseModel
{
    /**
     * Application container implemented by PSR-7.
     *
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * PDO connection injected via PHP-DI.
     *
     * @var \PDO|mixed
     */
    protected \PDO $pdo;

    /**
     * Identified of model like in database.
     *
     * @var int
     */
    protected int $idModel;

    /**
     * Table name, set up in child classes.
     *
     * @var string
     */
    protected string $table;

    /**
     * Primary key field name, set up in child classes.
     *
     * @var string
     */
    protected string $primaryKey;

    /**
     * Creates model and injects Database and Container classes.
     *
     * BaseModel constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->pdo = $this->container->get(Database::class);
    }

    /**
     * Returns all rows from database.
     *
     * @return array
     */
    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->getTableName()}");

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Returns current model table name.
     * @return string
     */
    protected function getTableName(): string
    {
        return $this->table;
    }

    /**
     * Returns current model primary column name.
     *
     * @return string
     */
    protected function getPrimaryKeyColumn(): string
    {
        return $this->primaryKey;
    }

    /**
     * Returns model identifier like in database.
     *
     * @return int
     */
    protected function getModelId(): int
    {
        return $this->idModel;
    }

    /**
     * Sets up model identifier.
     *
     * @param int $id
     */
    protected function setModelId(int $id): void
    {
        $this->idModel = $id;
    }
}