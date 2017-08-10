<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JobDetailsAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_details_audit',function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('employer_id')->unsigned();
            $table->foreign('employer_id')->references('employer_id')->on('employer_signup')->onDelete('cascade')->onUpdate('restrict');
            $table->tinyInteger('withdraw_job_submission');
            $table->string('pm_id');
            $table->string('domains_id');
            $table->tinyInteger('level');
            $table->string('annual_salary');
            $table->timestamps();
            $table->dateTime('audit_created_at');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_details_audit');
    }
}
