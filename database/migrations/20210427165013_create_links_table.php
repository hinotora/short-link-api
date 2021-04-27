<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLinksTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('links', ['id' => 'link_id']);

        $table
            ->addColumn('user_id', 'integer')
                ->addForeignKey('user_id', 'users', 'user_id')
            ->addColumn('short', 'string', ['limit' => 32])
            ->addColumn('full', 'string', ['limit' => 256])
            ->addColumn('created_at', 'datetime')
            ->addColumn('redirects_count', 'integer')
            ->create();
    }
}
