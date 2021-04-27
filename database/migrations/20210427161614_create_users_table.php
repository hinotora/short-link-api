<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users', ['id' => 'user_id']);

        $table
            ->addColumn('email', 'string', ['limit' => 64])
            ->addColumn('password', 'string', ['limit' => 64])
            ->addColumn('created_at', 'datetime')
            ->addColumn('last_seen', 'datetime')
            ->create();
    }
}
