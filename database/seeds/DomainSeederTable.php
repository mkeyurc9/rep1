<?php

use Illuminate\Database\Seeder;

class DomainSeederTable extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('domains')->insert([
                [
            'name' => 'Web',
            'order'=> 1
                ], [
            'name' => 'ecommerce',
            'order'=> 2       
                ], [
            'name' => 'Finance',
            'order'=> 3
                ], [
            'name' => 'B2B',
            'order'=> 4
                ], [
            'name' => 'B2C',
            'order'=> 5
                ], [
            'name' => 'Payments',
            'order'=> 6
                ], [
            'name' => 'Subscription',
            'order'=> 7
                ], [
            'name' => 'Marketing',
            'order'=> 8
                ], [
            'name' => 'SEO',
            'order'=> 9
                ], [
            'name' => 'Retail',
            'order'=> 10
                ], [
            'name' => 'Startup',
            'order'=> 11
                ], [
            'name' => 'API',
            'order'=> 12
                ], [
            'name' => 'UX',
            'order'=> 13
                ], [
            'name' => 'Design',
            'order'=> 14
                ], [
            'name' => 'Growth',
            'order'=> 15
                ], [
            'name' => 'Entertainment',
            'order'=> 16
                ]
        ]);
    }

}
