<?php

namespace App\EmployerModel;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job_details';
    protected $fillable = [
        'title','description','withdraw_job_submission','pm_id','domains_id','level',
        'annual_salary','location'
    ];
    function employer_status(){
        return $this->hasMany('App\Model\MatchingAlgo','job_id','id');
    }
}
