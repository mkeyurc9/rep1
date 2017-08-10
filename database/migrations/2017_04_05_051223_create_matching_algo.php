<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchingAlgo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('mat_algo',function(Blueprint $table){
            $table->increments('id');
            $table->date('run_date');
            $table->integer('candidate_id')->unsigned();
            $table->foreign('candidate_id')->references('candidate_id')->on('candidate_signup')->onDelete('cascade')->onUpdate('restrict');
            $table->integer('employer_id')->unsigned();
            $table->foreign('employer_id')->references('employer_id')->on('employer_signup')->onDelete('cascade')->onUpdate('restrict');
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('job_details')->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('mat_algo',function(Blueprint $table){
           $table->dropForeign('mat_algo_candidate_id_foreign');
           $table->dropForeign('mat_algo_employer_id_foreign');
           $table->dropForeign('mat_algo_job_id_foreign');
       });
       Schema::dropIfExists('mat_algo');
    }
}
