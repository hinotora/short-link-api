<?php

namespace App\Models;

class Link extends BaseModel
{
    protected string $table = 'links';
    protected string $primaryKey = 'link_id';

    public function find(string $slug): bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->getTableName()} WHERE short = :slug");
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();

        if ($stmt->rowCount() != 0) {
            $id = $stmt->fetch(\PDO::FETCH_ASSOC)[$this->getPrimaryKeyColumn()];
            $this->setModelId($id);

            return true;
        } else {
            return false;
        }
    }

    public function getUrl(): string
    {
        $stmt = $this->pdo->query(
            "SELECT full FROM {$this->getTableName()} WHERE {$this->getPrimaryKeyColumn()} = {$this->getModelId()}"
        );

        return $stmt->fetch(\PDO::FETCH_ASSOC)['full'];
    }

    public function incrementRedirect(): static
    {
        $this->pdo->query(<<<SQL
                    UPDATE {$this->getTableName()} 
                    SET redirects_count = redirects_count + 1 
                    WHERE {$this->getPrimaryKeyColumn()} = {$this->getModelId()}
        SQL);

        return $this;
    }
}