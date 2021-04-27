<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            'email' => 'test@mail.com',
            'password' => 'root',
            'created_at' => now(),
            'last_seen' => now(),
        ];

        $this->table('users')->insert($data)->save();
    }
}
