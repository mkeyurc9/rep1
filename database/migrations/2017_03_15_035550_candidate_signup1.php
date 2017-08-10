<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CandidateSignup1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('candidate_signup', function (Blueprint $table) {
            $table->increments('candidate_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('password');
            $table->string('activation_token')->nullable();
            $table->tinyInteger('is_activated')->default(0);
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
       Schema::dropIfExists('candidate_signup');
    }
}
