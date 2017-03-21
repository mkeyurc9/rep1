<?php

use Illuminate\Database\Seeder;

class pm_experience extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('pm_experience')->insert([
            [
                'name' => '0-1',
                'order' => 1
            ],
            [
                'name' => '1-2',
                'order' => 2
            ],
            [
                'name' => '2-4',
                'order' => 3
            ],
            [
                'name' => '4+',
                'order' => 4
            ]
        ]);
    }
}
