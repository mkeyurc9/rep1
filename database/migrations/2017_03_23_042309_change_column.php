<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matching_algo_status',function(Blueprint $table){
            $table->dropColumn('candidate_status');
            $table->dropColumn('employer_status');
        });
        Schema::table('matching_algo_status',function(Blueprint $table){
            $table->enum('candidate_status',['P','A','D','S'])->default('P')->after('job_id');
            $table->enum('employer_status',['N','P','A','D','R','S'])->default('N')->after('candidate_status');
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
