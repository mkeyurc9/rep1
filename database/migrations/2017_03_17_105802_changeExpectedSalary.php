<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeExpectedSalary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `candidate_profile` CHANGE `expected_salary` `expected_salary` INT NOT NULL ');
        DB::statement('ALTER TABLE `candidate_profile_audit` CHANGE `expected_salary` `expected_salary` INT NOT NULL ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
