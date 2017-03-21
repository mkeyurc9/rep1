<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToAuditProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_profile_audit',function(Blueprint $table){
            $table->dateTime('audit_created_at')->nullable()->after('updated_at'); 
            $table->enum('profile_status',['A','I'])->default('A')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('candidate_profile_audit',function(Blueprint $table){
           $table->dropColumn('audit_created_at');
           $table->dropColumn('profile_status');
       });
    }
}
