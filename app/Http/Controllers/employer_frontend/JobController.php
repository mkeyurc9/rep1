<?php

namespace App\Http\Controllers\employer_frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\EmployerModel\Job as JobDetails;

class JobController extends Controller
{
    /**
     * 
     * create
     * 
     * used to show create page
     * 
     * @param Request $request
     * @return Response
     */
    function create(Request $request){
        $domains = \DB::table('domains')->get(['name', 'id']);
        $product_management_type = \DB::table('product_management_type')->get(['name', 'id']);
        $pm_experiences = \DB::table('pm_experience')->get(['name', 'id']);
        return view('employer_frontend.job.add_job',['domains' => $domains, 'product_management_type' => $product_management_type,'pm_experiences'=>$pm_experiences]);

    }
 /**
  * 
  * store_job
  * 
  * used to add job to database
  * 
  * @param Request $request
  * @return Response
  */
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
            'annual_salary' => $request['annual_salary'],
            'location' => $request['job_location'],
            'created_at' => date('Y-m-d H:i:s '),
            'updated_at' => date('Y-m-d H:i:s')
        );
        JobDetails::insert($job_details);
        return redirect('/home');
    }
    /**
     * 
     * view_add_job
     * 
     * used to view the job page
     * 
     * @param Request $request
     * @return Response
     */
    function view_add_job(Request $request){
        $data = $request->session()->all();
        $jobs = JobDetails::where('employer_id',$data['id'])
                           ->select(\DB::raw("*, (SELECT COUNT(1) FROM matching_algo_status WHERE candidate_status= 'A'AND employer_status='P') as cnt_pending_review, (SELECT COUNT(1) FROM matching_algo_status WHERE candidate_status= 'A'AND employer_status='A') as active_in_interview_phase,(SELECT COUNT(1) FROM matching_algo_status WHERE candidate_status= 'D'AND employer_status='D') as candidates_not_considered,(SELECT COUNT(1) FROM matching_algo_status WHERE candidate_status= 'D'AND employer_status='R') as candidates_rejected"))
                           ->orderby('created_at','desc')
                           ->paginate(10);
        return view('employer_frontend.job.view_add_job',['jobs'=>$jobs]);
    }
    /**
     * 
     * edit_job
     * 
     * used to edit job
     * 
     * @param Request $request
     * @param Response $id
     */
    function edit_job(Request $request,$id){
        $domains = \DB::table('domains')->get(['name', 'id']);
        $product_management_type = \DB::table('product_management_type')->get(['name', 'id']);
        $pm_experiences = \DB::table('pm_experience')->get(['name', 'id']);
        $job = JobDetails::where('id',$id)->first();
        return view('employer_frontend.job.edit_job',['job'=>$job,'domains' => $domains, 'product_management_type' => $product_management_type,'pm_experiences'=>$pm_experiences]);      
    }
    /**
     * 
     * update_job
     * 
     * used to update job
     * @param Request $request
     */
    function update_job(Request $request,$id){
        $this->validate($request, [
            'job_title' => 'required',
            'job_description' => 'required'
        ]); 
        
        $data = $request->session()->all();
        $p_arr = $request['job_type'];
        $d_arr = $request['domains'];

        $old_data=JobDetails::where('employer_id',$data['id'])
                              ->where('id',$id)
                              ->first();
                     
         $old_data['audit_created_at'] = date('Y-m-d H:i:s');  
         \DB::table('job_details_audit')->insert([$old_data->toArray()]);
        
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
                'annual_salary' => $request['annual_salary'],
                'location' => $request['job_location'],
                'created_at' => $request['created_at'],
                'updated_at' => date('Y-m-d H:i:s')
        );
        JobDetails::where('id',$id)->update($job_details);
        return redirect('view_add_job'); 
    }
}
