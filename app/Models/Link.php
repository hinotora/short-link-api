<?php

namespace App\Models;

use App\Services\Settings;
use Slim\App;

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
            "SELECT full_link FROM {$this->getTableName()} WHERE {$this->getPrimaryKeyColumn()} = {$this->getModelId()}"
        );

        return $stmt->fetch(\PDO::FETCH_ASSOC)['full_link'];
    }

    public function incrementRedirect(): static
    {
        $this->pdo->query(" UPDATE {$this->getTableName()}  SET redirects_count = redirects_count + 1 
                                    WHERE {$this->getPrimaryKeyColumn()} = {$this->getModelId()}
        ");

        return $this;
    }

    public function info() {
        $stmt = $this->pdo->query(
            "SELECT short, full_link, created_at, redirects_count  FROM {$this->getTableName()} 
                        WHERE {$this->getPrimaryKeyColumn()} = {$this->getModelId()}"
        );

        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        $data['short'] = appUrl('/'.$data['short']);

        return $data;
    }

    public function store(string $newLink): bool
    {
        $db_driver = environ('DB_DRIVER');

        $fullUrl = $newLink;
        $shortUrl = randomStr();
        $createdAt = now();

        $sql = " INSERT INTO {$this->getTableName()} (short, full_link, created_at) VALUES(:short, :full, :created_at)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':short', $shortUrl);
        $stmt->bindParam(':full', $fullUrl);
        $stmt->bindParam('created_at', $createdAt);

        if ($stmt->execute()) {
            if ($db_driver != 'pgsql') {
                $stmt = $this->pdo->query('SELECT LAST_INSERT_ID() AS last');
            } else {
                $stmt = $this->pdo->query("SELECT currval('links_link_id_seq') as last");
            }


            $idModel = $stmt->fetch()['last'];

            $this->setModelId($idModel);

            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        try {
            $this->pdo->query("DELETE FROM {$this->getTableName()} WHERE {$this->getPrimaryKeyColumn()} = {$this->getModelId()}");
        } catch (\PDOException $a) {
            return false;
        } finally {
            return true;
        }
    }
}