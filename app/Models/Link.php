<?php

namespace App\Models;

use App\Services\Settings;
use Slim\App;

class Link extends BaseModel
{
    /**
     * Table name and PK fields name.
     *
     * @var string
     */
    protected string $table = 'links';
    protected string $primaryKey = 'link_id';

    /**
     * Finds link with short url in database and sets up model id.
     * Returns true if find, and false if not.
     *
     * @param string $slug
     * @return bool
     */
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

    /**
     * Returns full link with short url.
     *
     * @return string
     */
    public function getUrl(): string
    {
        $stmt = $this->pdo->query(
            "SELECT full_link FROM {$this->getTableName()} WHERE {$this->getPrimaryKeyColumn()} = {$this->getModelId()}"
        );

        return $stmt->fetch(\PDO::FETCH_ASSOC)['full_link'];
    }

    /**
     * Increments redirect_count field in database then user is being redirected.
     *
     * @return $this
     */
    public function incrementRedirect(): Link
    {
        $this->pdo->query(" UPDATE {$this->getTableName()}  SET redirects_count = redirects_count + 1 
                                    WHERE {$this->getPrimaryKeyColumn()} = {$this->getModelId()}
        ");

        return $this;
    }

    /**
     * Returns full information about short link with redirect counts.
     *
     * @return mixed
     */
    public function info(): array {
        $stmt = $this->pdo->query(
            "SELECT short, full_link, created_at, redirects_count  FROM {$this->getTableName()} 
                        WHERE {$this->getPrimaryKeyColumn()} = {$this->getModelId()}"
        );

        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        $data['short'] = appUrl('/'.$data['short']);

        return $data;
    }

    /**
     * Stores new link in database. Returns true if success and false if not.
     *
     * @param string $newLink
     * @return bool
     * @throws \Exception
     */
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

    /**
     * Removes link from database with model identifier.
     *
     * @return bool
     */
    public function delete(): bool
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