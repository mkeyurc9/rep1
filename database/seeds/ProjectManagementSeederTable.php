<?php

use Illuminate\Database\Seeder;

class ProjectManagementSeederTable extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('product_management_type')->insert([
            [
                'name' => 'Technical PM',
                'order' => 1
            ],
            [
                'name' => 'Product Marketing PM',
                'order' => 2
            ],
            [
                'name' => 'Project Management PM',
                'order' => 3
            ],
            [
                'name' => 'Growth PM ',
                'order' => 4
            ],
            [
                'name' => 'Other',
                'order' => 5
            ]
        ]);
    }

}
