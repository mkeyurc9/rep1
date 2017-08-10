<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompositeKeyToMatAlgo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matching_algo_status',function(Blueprint $table){
           $table->unique(['candidate_id', 'job_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('matching_algo_status',function(){
           $table->dropUnique(['candidate_id', 'job_id']);
       });
    }
}
