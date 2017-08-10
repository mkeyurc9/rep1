<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDatatypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `candidate_profile` CHANGE `pm_id` `pm_id` VARCHAR( 190 ) NULL DEFAULT NULL');
        DB::statement('ALTER TABLE `candidate_profile` CHANGE `domains_id` `domains_id` VARCHAR( 190 ) NULL DEFAULT NULL');
        DB::statement('ALTER TABLE `candidate_profile_audit` CHANGE `pm_id` `pm_id` VARCHAR( 190 ) NULL DEFAULT NULL');
        DB::statement('ALTER TABLE `candidate_profile_audit` CHANGE `domains_id` `domains_id` VARCHAR( 190 ) NULL DEFAULT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
