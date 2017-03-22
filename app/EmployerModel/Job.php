<?php

namespace App\EmployerModel;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job_details';
    protecte $fillable = [
        'actively_looking','pm_id','pm_experiance_in_years','job_level','expected_salary','domains_id',
        'exclude_companies','authorized_to_work_in_us','need_sponsorship_for_employment_visa_status',
       'relocation_required','willing_to_relocate','resume',
    ];
}
