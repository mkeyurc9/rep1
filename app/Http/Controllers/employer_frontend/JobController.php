<?php

namespace App\Http\Controllers\employer_frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\EmployerModel\Job as JobDetails;

class JobController extends Controller
{
    function create(Request $request){
        $domains = \DB::table('domains')->get(['name', 'id']);
        $product_management_type = \DB::table('product_management_type')->get(['name', 'id']);
        $pm_experiences = \DB::table('pm_experience')->get(['name', 'id']);

        return view('employer_frontend.job.add_job',['domains' => $domains, 'product_management_type' => $product_management_type,'pm_experiences'=>$pm_experiences]);

    }

    function store_job(Request $request) {
        $this->validate($request, [
            'job_title' => 'required',
            'job_description' => 'required'
        ]);

        $data = $request->session()->all();
        $p_arr = $request['job_type'];
        $d_arr = $request['domains'];

        $pm_id = implode(',', $p_arr);
        $domains_id = implode(',', $d_arr);

        $job_details = array(
            'title' => $request['job_title'],
            'description' => $request['job_description'],
            'employer_id' => $data['id'],
            'withdraw_job_submission' => $request['withdraw_job_submission']?$request['withdraw_job_submission']:0,
            'pm_id' => $pm_id,
            'domains_id' => $domains_id,
            'level' => $request['job_level'],
            //'pm_experiance_in_years' => $request['pm_experience_in_years'],
            'annual_salary' => $request['annual_salary'],
            'location' => $request['job_location'],
            'created_at' => date('Y-m-d H:i:s '),
            'updated_at' => date('Y-m-d H:i:s')
        );
        JobDetails::insert($job_details);
        return redirect('/home');
    }
    
    function view_add_job(Request $request){
        $data = $request->session()->all();
//        $jobs = JobDetails::where('employer_id',$data['id'])
//                            ->with('employer_status')
//                            ->paginate(10);
//        $jobs = \DB::raw("SELECT e.*, (SELECT COUNT(1) FROM matching_algo_status WHERE candidate_status= 'A'AND employer_status='P') as cnt_pending_review, (SELECT COUNT(1) FROM matching_algo_status WHERE candidate_status= 'A'AND employer_status='A') as active_in_interview_phase,(SELECT COUNT(1) FROM matching_algo_status WHERE candidate_status= 'D'AND employer_status='D') as candidates_not_considered,(SELECT COUNT(1) FROM matching_algo_status WHERE candidate_status= 'D'AND employer_status='R') as candidates_rejected FROM e.job_details WHERE e.employer_id =". $data['id']);
        $jobs = JobDetails::where('employer_id',$data['id'])
                           ->select(\DB::raw("*, (SELECT COUNT(1) FROM matching_algo_status WHERE candidate_status= 'A'AND employer_status='P') as cnt_pending_review, (SELECT COUNT(1) FROM matching_algo_status WHERE candidate_status= 'A'AND employer_status='A') as active_in_interview_phase,(SELECT COUNT(1) FROM matching_algo_status WHERE candidate_status= 'D'AND employer_status='D') as candidates_not_considered,(SELECT COUNT(1) FROM matching_algo_status WHERE candidate_status= 'D'AND employer_status='R') as candidates_rejected"))
                           ->orderby('created_at','desc')
                           ->paginate(10);
        return view('employer_frontend.job.view_add_job',['jobs'=>$jobs]);
    }
}
