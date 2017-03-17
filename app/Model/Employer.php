<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
     /**
     *The attributes that are mass assignable.
     * 
     * @var type 
     */
    protected $table = 'employer_signup';
    protected $fillable = [
        'firstname','lastname','email','password','phone_number','company_name','company_url',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   protected $hidden = [
        'password'
    ];
}
