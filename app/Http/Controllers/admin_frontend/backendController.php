<?php

namespace App\Http\Controllers\admin_frontend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Candidate;
use DB;
class backendController extends Controller
{

	public function getuser()
	{

		$status='';
		$to='';
		$from='';
		$users = DB::table('candidate_signup')
            ->join('matching_algo_status', 'candidate_signup.candidate_id', '=', 'matching_algo_status.candidate_id')
            ->join('employer_signup', 'employer_signup.employer_id', '=', 'matching_algo_status.employer_id')
            ->join('job_details','job_details.id','=','matching_algo_status.job_id')
            ->select('candidate_signup.firstname as c_F','candidate_signup.lastname as c_L','matching_algo_status.candidate_status as c_Status','employer_signup.firstname as e_F','employer_signup.lastname as e_L','matching_algo_status.employer_status as e_Status','job_details.title as job_title','matching_algo_status.updated_at as s_Date')
            ->orderBy('matching_algo_status.id', 'desc')
            ->Paginate(2);
            //get();

		return view('jobzerda_admin.candidate_list',['users'=>$users,'status'=>$status,'to'=>$to,'from'=>$from]);

	}
	public function filter_user(Request $request)
	{
		if($request['to']=='')
			$request['to']=date('y-m-d');
		$this->validate($request, [
            'from' => 'required',
             'to'=> 'sometimes|after_or_equal:from',
		]);

		$from=$request['from'];
		$to=$request['to'];
		$status=$request['condition'];
		
		

		$condition=array(
							'candidate_status'=>'P',
							'employer_status'=>'N',
						);
		if($status==0)
		{
			$condition=array(
								'candidate_status'=>'P',
								'employer_status'=>'N',
							);
		}
		else if($status==1)
		{
			$condition=array(
								'candidate_status'=>'D',
								'employer_status'=>'N',
							);
		}
		else if($status==2)
		{
			$condition=array(
								'candidate_status'=>'A',
								'employer_status'=>'P',
							);
		}
		else if($status==3)
		{
			$condition=array(
								'candidate_status'=>'D',
								'employer_status'=>'D',
							);
		}
		else if($status==4)
		{
			$condition=array(
								'candidate_status'=>'A',
								'employer_status'=>'A',
							);
		}
		else if($status==5)
		{
			$condition=array(
								'candidate_status'=>'D',
								'employer_status'=>'R',
							);
		}
		else if($status==6)
		{
			$condition=array(
								'candidate_status'=>'S',
								'employer_status'=>'S',
							);
		}
		else
		{
			$condition=array(
								'candidate_status'=>'P',
								'employer_status'=>'N',
							);
		}

		if($from!='' &&  $to!='')
		{

			$users = DB::table('candidate_signup')
				->join('matching_algo_status', 'candidate_signup.candidate_id', '=', 'matching_algo_status.candidate_id')
	            ->join('employer_signup', 'employer_signup.employer_id', '=', 'matching_algo_status.employer_id')
	            ->join('job_details','job_details.id','=','matching_algo_status.job_id')
	            ->select('candidate_signup.firstname as c_F','candidate_signup.lastname as c_L','matching_algo_status.candidate_status as c_Status','employer_signup.firstname as e_F','employer_signup.lastname as e_L','matching_algo_status.employer_status as e_Status','job_details.title as job_title','matching_algo_status.updated_at as s_Date')
	            ->WHERE($condition)->orderBy('matching_algo_status.id', 'desc')
	            ->WhereBetween('matching_algo_status.updated_at', [$from, $to])
	            ->Paginate(2);
				return view('jobzerda_admin.candidate_list',['users'=>$users,'status'=>$status,'to'=>$to,'from'=>$from]);
		}
		else if($from!='' && $to=='')
		{
			$users = DB::table('candidate_signup')
				->join('matching_algo_status', 'candidate_signup.candidate_id', '=', 'matching_algo_status.candidate_id')
	            ->join('employer_signup', 'employer_signup.employer_id', '=', 'matching_algo_status.employer_id')
	            ->join('job_details','job_details.id','=','matching_algo_status.job_id')
	            ->select('candidate_signup.firstname as c_F','candidate_signup.lastname as c_L','matching_algo_status.candidate_status as c_Status','employer_signup.firstname as e_F','employer_signup.lastname as e_L','matching_algo_status.employer_status as e_Status','job_details.title as job_title','matching_algo_status.updated_at as s_Date')
	            ->WHERE($condition)->orderBy('matching_algo_status.id', 'desc')
	            ->WHERE('matching_algo_status.updated_at','>=', $from)
	            ->Paginate(2);
				return view('jobzerda_admin.candidate_list',['users'=>$users,'status'=>$status,'to'=>$to,'from'=>$from]);
		}
		else 
		{
			$users = DB::table('candidate_signup')
				->join('matching_algo_status', 'candidate_signup.candidate_id', '=', 'matching_algo_status.candidate_id')
	            ->join('employer_signup', 'employer_signup.employer_id', '=', 'matching_algo_status.employer_id')
	            ->join('job_details','job_details.id','=','matching_algo_status.job_id')
	            ->select('candidate_signup.firstname as c_F','candidate_signup.lastname as c_L','matching_algo_status.candidate_status as c_Status','employer_signup.firstname as e_F','employer_signup.lastname as e_L','matching_algo_status.employer_status as e_Status','job_details.title as job_title','matching_algo_status.updated_at as s_Date')
	            ->WHERE($condition)->orderBy('matching_algo_status.id', 'desc')
	            ->Paginate(2);
				return view('jobzerda_admin.candidate_list',['users'=>$users,'status'=>$status,'to'=>$to,'from'=>$from]);
		}
	}
}