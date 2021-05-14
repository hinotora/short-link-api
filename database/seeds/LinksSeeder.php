<?php


use Phinx\Seed\AbstractSeed;

class LinksSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'short' => 'somelinkfromdbseeder',
                'full' => 'https://google.com/',
                'created_at' => now(),
                'redirects_count' => '0'
            ],
        ];

        $this->table('links')->insert($data)->save();
    }
}
