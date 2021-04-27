<?php


use Phinx\Seed\AbstractSeed;

class LinksSeeder extends AbstractSeed
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
            [
                'user_id' => '1',
                'short' => 'DfgfFFjfk',
                'full' => 'https://google.com/',
                'created_at' => now(),
                'redirects_count' => '0'
            ],
            [
                'user_id' => '1',
                'short' => 'FdgFFdrgd',
                'full' => 'https://instagram.com/',
                'created_at' => now(),
                'redirects_count' => '0'
            ],
        ];

        $this->table('links')->insert($data)->save();
    }
}
