<?php

namespace App\Http\Controllers\employer_frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\EmployerModel\Job as JobDetails;
use App\Model\MatchingAlgo as MatchingAlgo;
use App\Model\Candidate as Candidate;

class JobController extends Controller {

    /**
     * 
     * create
     * 
     * used to show create page
     * 
     * @param Request $request
     * @return Response
     */
    function create(Request $request) {
        $domains = \DB::table('domains')->get(['name', 'id']);
        $product_management_type = \DB::table('product_management_type')->get(['name', 'id']);
        $pm_experiences = \DB::table('pm_experience')->get(['name', 'id']);
        return view('employer_frontend.job.add_job', ['domains' => $domains, 'product_management_type' => $product_management_type, 'pm_experiences' => $pm_experiences]);
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
            'withdraw_job_submission' => $request['withdraw_job_submission'] ? $request['withdraw_job_submission'] : 0,
            'pm_id' => $pm_id,
            'domains_id' => $domains_id,
            'level' => $request['job_level'],
            'annual_salary' => $request['annual_salary'],
            'location' => $request['job_location'],
            'created_at' => date('Y-m-d H:i:s '),
            'updated_at' => date('Y-m-d H:i:s')
        );
        JobDetails::insert($job_details);
        return redirect('view_add_job');
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
    function view_add_job(Request $request) {
        $data = $request->session()->all();
        //\DB::enableQueryLog();
        $jobs = \DB::table('job_details as jd')->where('employer_id',$data['id'])
                           ->select(\DB::raw("*, (SELECT COUNT(1) FROM matching_algo_status WHERE job_id = jd.id 
AND candidate_status= 'A'AND employer_status='P') as cnt_pending_review, (SELECT COUNT(1) FROM matching_algo_status WHERE job_id = jd.id AND candidate_status= 'A'AND employer_status='A') as active_in_interview_phase,(SELECT COUNT(1) FROM matching_algo_status WHERE job_id = jd.id AND candidate_status= 'D'AND employer_status='D') as candidates_not_considered,(SELECT COUNT(1) FROM matching_algo_status WHERE job_id = jd.id AND candidate_status= 'D'AND employer_status='R') as candidates_rejected,(SELECT COUNT(1) FROM matching_algo_status WHERE job_id = jd.id AND candidate_status= 'S'AND employer_status='S') as candidate_success"))
                           ->orderby('created_at','desc')
                           ->paginate(10);
        //print_r(\DB::getQueryLog());exit;
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
    function edit_job(Request $request, $id) {
        $domains = \DB::table('domains')->get(['name', 'id']);
        $product_management_type = \DB::table('product_management_type')->get(['name', 'id']);
        $pm_experiences = \DB::table('pm_experience')->get(['name', 'id']);
        $job = JobDetails::where('id', $id)->first();
        return view('employer_frontend.job.edit_job', ['job' => $job, 'domains' => $domains, 'product_management_type' => $product_management_type, 'pm_experiences' => $pm_experiences]);
    }

    /**
     * 
     * update_job
     * 
     * used to update job
     * @param Request $request
     */
    function update_job(Request $request, $id) {
        $this->validate($request, [
            'job_title' => 'required',
            'job_description' => 'required'
        ]);

        $data = $request->session()->all();
        $p_arr = $request['job_type'];
        $d_arr = $request['domains'];
        
        $old_data = JobDetails::where('employer_id', $data['id'])
                ->where('id', $id)
                ->first();
        unset($old_data['id']);
        $old_data['audit_created_at'] = date('Y-m-d H:i:s');
        \DB::table('job_details_audit')->insert([$old_data->toArray()]);

        $pm_id = implode(',', $p_arr);
        $domains_id = implode(',', $d_arr);

        $job_details = array(
            'title' => $request['job_title'],
            'description' => $request['job_description'],
            'employer_id' => $data['id'],
            'withdraw_job_submission' => $request['withdraw_job_submission'] ? $request['withdraw_job_submission'] : 0,
            'pm_id' => $pm_id,
            'domains_id' => $domains_id,
            'level' => $request['job_level'],
            'annual_salary' => $request['annual_salary'],
            'location' => $request['job_location'],
            'created_at' => $old_data['created_at'],
            'updated_at' => date('Y-m-d H:i:s')
        );

        //made changes
        if($request['withdraw_job_submission']==1)
        {
            $job_close=array(
                'job_id'=>$id,
                'flag'=>'W',
                'created_at' => date('Y-m-d H:i:s')
                );
            \DB::table('job_closed')->insert([$job_close]);

        }
        JobDetails::where('id', $id)->update($job_details);
        return redirect('view_add_job');
    }

    /**
     * 
     * view_employer_job
     * 
     * used to display job description
     * 
     * @param integer $id
     * @return Response
     */
    function view_employer_job($id) {
        $job = JobDetails::where('id', $id)
                ->with('employer_status')
                ->first();
        $pending = MatchingAlgo::with('candidate_signup')->where('job_id', $id)->where(['candidate_status' => 'A', 'employer_status' => 'P'])->get();
        $active = MatchingAlgo::with('candidate_signup')->where('job_id', $id)->where(['candidate_status' => 'A', 'employer_status' => 'A'])->get();
        $process = MatchingAlgo::with('candidate_signup')->where('job_id', $id)->where(['candidate_status' => 'D', 'employer_status' => 'D'])->get();
        $success = MatchingAlgo::with('candidate_signup')->where('job_id', $id)->where(['candidate_status' => 'S', 'employer_status' => 'S'])->get();
        $rejected = MatchingAlgo::with('candidate_signup')->where('job_id', $id)->where(['candidate_status' => 'D', 'employer_status' => 'R'])->get();
        $arr_domains = explode(',', $job['domains_id']);
        $pm_experiences = \DB::table('domains')->whereIn('id', $arr_domains)->get();
        $arr_interest = explode(',', $job['pm_id']);
        $product_management_type = \DB::table('product_management_type')->whereIn('id', $arr_interest)->get();
        return view('employer_frontend.job.view_employer_job', ['success' => $success,'rejected' => $rejected, 'process' => $process, 'pending' => $pending, 'active' => $active, 'job' => $job, 'domains' => $product_management_type, 'pm_experiences' => $pm_experiences]);
    }

    function employer_candidate_profile($id,$jobid) {
        $matching_algo = MatchingAlgo::where('id', $id)
                        ->with('candidate_signup')->first();
        $candidate = Candidate::where('candidate_id', $matching_algo['candidate_signup'][0]['candidate_id'])->with('profile')->first();
        return view('employer_frontend.job.employer_candidate_profile', ['candidate'=>$candidate,'mat_algo' => $matching_algo,'job'=>$jobid]);
    }

    function update_employer_candidate_profile(Request $req,$id,$jobid) {
        $this->validate($req, [
            'employer_status' => 'required'
        ]);
        $e_status = $req['employer_status'];
        $c_status = $req['candidate_status'];
        $status = $req['employer_job_status'];
        if ($status == 1) {
            if($c_status=='A' && $e_status=='P'){
            $data['candidate_status'] = 'A';
            $data['employer_status'] = 'A';
            }else{
                $data['candidate_status'] = 'S';
                $data['employer_status'] = 'S';
            }
        } elseif($status == 0 && $c_status=='A' && $e_status=='A'){
            $data['candidate_status'] = 'D';
            $data['employer_status'] = 'R';
        }else{
            $data['candidate_status'] = 'D';
            $data['employer_status'] = 'D';
        }

        MatchingAlgo::where('id', $id)->update($data);

        //made changes 
        if($data['candidate_status'] =='S' && $data['employer_status'] =='S')
        {
              $job_close=array(
                'job_id'=>$jobid,
                'flag'=>'S',
                'created_at' => date('Y-m-d H:i:s')
                );
            \DB::table('job_closed')->insert([$job_close]);
        }
        return redirect('employer_candidate_profile/'.$id.'/'.$jobid);
    }

}
