<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_base', function (Blueprint $table) {
              $table->increments('id');

            $table->integer('employer_id')->unsigned();
            $table->foreign('employer_id')->references('employer_id')->on('employer_signup')->onDelete('cascade')->onUpdate('restrict');


            $table->integer('candidate_id')->unsigned();
            $table->foreign('candidate_id')->references('candidate_id')->on('candidate_signup')->onDelete('cascade')->onUpdate('restrict');
          
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('job_details')->onDelete('cascade')->onUpdate('restrict');


            $table->integer('matching_algo_status_id')->unsigned();
            $table->foreign('matching_algo_status_id')->references('id')->on('matching_algo_status')->onDelete('cascade')->onUpdate('restrict');
            
            $table->enum('payment_setting',['F','I'])->default('F');

            $table->decimal('total_payment');
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
        Schema::dropIfExists('payment_base');
    }
}
