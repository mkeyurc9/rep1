<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnToProfileAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_profile',function(Blueprint $table){
            $table->dropColumn('pm_experiance_in_years');
        });
        Schema::table('candidate_profile',function(Blueprint $table){
            $table->tinyInteger('pm_experiance_in_years')->after('pm_id');
        });
        Schema::table('candidate_profile_audit',function(Blueprint $table){
            $table->dropColumn('pm_experiance_in_years');
        });
        Schema::table('candidate_profile_audit',function(Blueprint $table){
            $table->tinyInteger('pm_experiance_in_years')->after('pm_id');
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
