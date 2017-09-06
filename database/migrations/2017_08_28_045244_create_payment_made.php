<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_made', function (Blueprint $table) {
             $table->increments('id');
            $table->integer('employer_id')->unsigned();
            $table->foreign('employer_id')->references('employer_id')->on('employer_signup')->onDelete('cascade')->onUpdate('restrict');


            $table->integer('candidate_id')->unsigned();
            $table->foreign('candidate_id')->references('candidate_id')->on('candidate_signup')->onDelete('cascade')->onUpdate('restrict');
          
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('job_details')->onDelete('cascade')->onUpdate('restrict');


            $table->integer('payment_base_id')->unsigned();
            $table->foreign('payment_base_id')->references('id')->on('payment_base')->onDelete('cascade')->onUpdate('restrict');

            $table->integer('payment_preprocessing_id')->unsigned();
            $table->foreign('payment_preprocessing_id')->references('id')->on('payment_preprocessing')->onDelete('cascade')->onUpdate('restrict');
           
            $table->enum('payment_setting',['F','I'])->default('F');

            $table->decimal('paid');
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
        Schema::dropIfExists('payment_made');
    }
}
