<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToJobDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_details',function(Blueprint $table){
            $table->tinyInteger('withdraw_job_submission')->default(0)->after('employer_id');
            $table->string('pm_id')->after('withdraw_job_submission');
            $table->string('domains_id')->after('pm_id');
            $table->tinyInteger('level')->after('domains_id');
            $table->string('annual_salary')->after('level');
        });
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
