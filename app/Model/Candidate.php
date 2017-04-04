<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
   protected $table = 'candidate_signup';
   protected $fillable = [
       'firstname','lastname','email','password','phone_number',
   ];
   /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   protected $hidden = [
        'password'
    ];
   function profile(){
       return $this->hasOne('App\Model\CandidateProfile','profile_candidate_id','candidate_id');
   }
}
