<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTokensTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('tokens', ['id' => 'token_id']);

        $table
            ->addColumn('user_id', 'integer')
                ->addForeignKey('user_id', 'users', 'user_id')
            ->addColumn('token', 'string', ['limit' => 64])
            ->addColumn('created_at', 'datetime')
            ->addColumn('until', 'datetime')
            ->create();
    }
}
