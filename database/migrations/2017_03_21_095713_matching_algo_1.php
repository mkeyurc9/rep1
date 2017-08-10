<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MatchingAlgo1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matching_algo',function(Blueprint $table){
           $table->increments('id');
           $table->integer('candidate_id')->unsigned();
           $table->foreign('candidate_id')->references('candidate_id')->on('candidate_signup')->onDelete('cascade')->onUpdate('restrict');
           $table->integer('employer_id')->unsigned();
           $table->foreign('employer_id')->references('employer_id')->on('employer_signup')->onDelete('cascade')->onUpdate('restrict');
           $table->integer('job_id')->unsigned();
           $table->foreign('job_id')->references('id')->on('job')->onDelete('cascade')->onUpdate('restrict');
           $table->enum('candidate_status',['N','P','A','D'])->default('P');
           $table->enum('employer_status',['N','P','A','D'])->default('N');
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
        Schema::dropIfExists('matching_algo');
    }
}
