<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNeedresponse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement('ALTER TABLE `candidate_profile` CHANGE `need_sponsorship_for_employment_visa_status` `need_sponsorship` TINYINT( 4 ) NOT NULL');
       DB::statement('ALTER TABLE `candidate_profile_audit` CHANGE `need_sponsorship_for_employment_visa_status` `need_sponsorship` TINYINT( 4 ) NOT NULL');
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
