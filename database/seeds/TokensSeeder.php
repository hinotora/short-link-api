<?php


use Phinx\Seed\AbstractSeed;

class TokensSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'UserSeeder',
        ];
    }

    public function run()
    {
        $data = [
            'user_id' => '1',
            'token' => 'abcdef',
            'created_at' => now(),
            'until' => now(),
        ];

        $this->table('tokens')->insert($data)->save();
    }
}
