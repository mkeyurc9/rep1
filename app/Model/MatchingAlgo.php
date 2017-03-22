<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MatchingAlgo extends Model
{
    protected $table = 'matching_algo';
    protected $fillable = [
        'candidate_status','employer_status',
    ];
    function employer_signup(){
        return $this->hasOne('App\Model\Employer','employer_id','employer_id');
    }
}
