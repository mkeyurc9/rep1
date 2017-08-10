<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CandidateProfileAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_profile_audit',function(Blueprint $table){
            $table->increments('id');
            $table->integer('profile_candidate_id')->unsigned();
            $table->foreign('profile_candidate_id')->references('candidate_id')->on('candidate_signup')->onDelete('cascade')->onUpdate('restrict');
            $table->tinyInteger('actively_looking');
            $table->tinyInteger('pm_id')->nullable();
            $table->string('pm_experiance_in_years');
            $table->string('job_level');
            $table->decimal('expected_salary',10,2);
            $table->tinyInteger('domains_id')->nullable();
            $table->text('exclude_companies')->nullable();
            $table->tinyInteger('authorized_to_work_in_us');
            $table->tinyInteger('need_sponsorship_for_employment_visa_status');
            $table->tinyInteger('relocation_required');
            $table->tinyInteger('willing_to_relocate');
            $table->enum('status',['pending','active','processed'])->default('pending');
            $table->string('resume');
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
        Schema::dropIfExists('candidate_profile_audit');
    }
}
