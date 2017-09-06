<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerPaymentSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_payment_setting', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('employer_id')->unsigned();

            $table->foreign('employer_id')->references('employer_id')->on('employer_signup')->onDelete('cascade')->onUpdate('restrict');
            
            $table->enum('payment_setting',['F','I'])->default('F');

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
        Schema::dropIfExists('employer_payment_setting');
    }
}
