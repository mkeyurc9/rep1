<?php

namespace App\Http\Controllers\admin_frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CandidateProfileController extends Controller
{

	public function get_candidate()
	{
		$status='';
		$users = DB::table('candidate_signup')
            ->join('candidate_profile', 'candidate_signup.candidate_id', '=', 'candidate_profile.profile_candidate_id')
            ->select('candidate_signup.firstname as c_F','candidate_signup.lastname as c_L','candidate_profile.pm_experiance_in_years as exper','candidate_profile.profile_status as PS',
            	'candidate_signup.email as email','candidate_signup.phone_number as phone','candidate_profile.resume','candidate_profile.updated_at')
            ->orderBy('candidate_signup.candidate_id', 'desc')
            ->Paginate(2);
            // return $users;
		return view('jobzerda_admin/candidate_profile',['users'=>$users,'status'=>$status]);
	}
	public function filter_candidate(request $request)
	{
		$status=$request['condition'];
		if($status=='')
		{
			$status=$request->input('status');
		}
		$condition=array();
		if($status==0)
		{
			$condition=array(
								
							);
		}
		else if($status==1)
		{
			$condition=array(
								'profile_status'=>'A'
							);
		}
		else if($status==2)
		{
			$condition=array(
								'profile_status'=>'I'
							);
		}

		$users = DB::table('candidate_signup')
            	->join('candidate_profile', 'candidate_signup.candidate_id', '=', 'candidate_profile.profile_candidate_id')
            	->select('candidate_signup.firstname as c_F','candidate_signup.lastname as c_L','candidate_profile.pm_experiance_in_years as exper','candidate_profile.profile_status as PS',
            	'candidate_signup.email as email','candidate_signup.phone_number as phone','candidate_profile.resume','candidate_profile.updated_at')
	            ->WHERE($condition)
	            ->orderBy('candidate_signup.candidate_id', 'desc')
	            ->Paginate(2);
				return view('jobzerda_admin/candidate_profile',['users'=>$users,'status'=>$status]);
	}
}

