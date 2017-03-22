<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLocaColumnToJobDetailsAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_details',function(Blueprint $table){
            $table->dropColumn('level');
        });
        Schema::table('job_details',function(Blueprint $table){
            $table->string('level')->after('domains_id');
        });
        Schema::table('job_details_audit',function(Blueprint $table){
            $table->dropColumn('level');
        });
        Schema::table('job_details_audit',function(Blueprint $table){
            $table->string('level')->after('domains_id');
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
