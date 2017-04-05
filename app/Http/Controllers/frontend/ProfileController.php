<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Model\CandidateProfile as CandidateProfile;

class ProfileController extends Controller {

    /**
     * 
     * index
     * 
     * used to show view profile
     * @return Response
     */
    function index(Request $request) {
        $data = $request->session()->all();
        $candidate_profile = CandidateProfile::where('profile_candidate_id', $data['id'])->first();
        $arr_domains = explode(',',$candidate_profile['domains_id']);
        $candidate_domains = \DB::table('domains')->whereIn('id', $arr_domains)->get();
        $arr_interest = explode(',',$candidate_profile['pm_id']);
        $interest_in = \DB::table('product_management_type')->whereIn('id', $arr_interest)->get(); 
        $pm_exp = $candidate_profile['pm_experiance_in_years']; 
        
        $domains = \DB::table('domains')->get(['name', 'id']);
        $product_management_type = \DB::table('product_management_type')->get(['name', 'id']);
        $pm_experiences = \DB::table('pm_experience')->get(['name', 'id']);
   
        return view('frontend.candidate_profile.view_profile', ['domains' => $domains, 'product_management_type' => $product_management_type,'candidate_profile' => $candidate_profile,'candidate_domains' => $candidate_domains,'interests' => $interest_in,'pm_exp'=> $pm_exp, 'pm_experiences'=>$pm_experiences]);
    }

    /**
     * 
     * create
     * 
     * @param Request $request
     */
    function create(Request $request) {
        $this->validate($request, [
            'exclude_company' => 'required',
            'expected_salary' => 'required',
            'profile_status' => 'required',
            'actively_looking' => 'required',
            'authorized_to_work_in_us' => 'required',
            'relocation_required' => 'required',
            'exclude_company' => 'required',
            'job_level' => 'required',
            'need_sponsorship_for_employment_visa_status' => 'required',
            'willing_to_relocate' => 'required',
            'relocation_required' => 'required'
        ]);

        $data = $request->session()->all();
        $p_arr = $request['interest_in'];
        $d_arr = $request['domains'];

        $pm_id = implode(',', $p_arr);
        $domains_id = implode(',', $d_arr);

        $check_candidate = CandidateProfile::where('profile_candidate_id', $data['id'])->first();
//        print_r($check_candidate->toArray());exit;
        if ($check_candidate) {
            $status = $check_candidate['status'];
        } else {
            $this->validate($request, [
            'resume' => 'required'
           ]);
            $status = 'pending';
        }
        $candidate_profile = array(
            'profile_status' => $request['profile_status'],
            'actively_looking' => $request['actively_looking'],
            'pm_id' => $pm_id,
            'profile_candidate_id' => $data['id'],
            'pm_experiance_in_years' => $request['pm_experience_in_years'],
            'job_level' => $request['job_level'],
            'expected_salary' => $request['expected_salary'],
            'domains_id' => $domains_id,
            'exclude_companies' => $request['exclude_company'],
            'authorized_to_work_in_us' => $request['authorized_to_work_in_us'],
            'need_sponsorship' => $request['need_sponsorship_for_employment_visa_status'],
            'relocation_required' => $request['relocation_required'],
            'willing_to_relocate' => $request['willing_to_relocate'],
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s '),
            'updated_at' => date('Y-m-d H:i:s')
        );
        
        if ($request->hasFile('resume')) {
        $inputResume = $request['resume'];
        $destinationPath = public_path() . '/upload_resume';
        $extension = $inputResume->getClientOriginalExtension();
        $resume = 'C' . '_' . $data['id'] . '_' . time() . '.' . $extension;
        $inputResume->move($destinationPath, $resume);
        $candidate_profile['resume']=$resume;
        }
        
        if ($check_candidate) {
            unset($check_candidate['id']);
            $check_candidate['audit_created_at'] = date('Y-m-d H:i:s');
            $check_candidate = $check_candidate->toArray();
            \DB::table('candidate_profile_audit')->insert([$check_candidate]);
            CandidateProfile::where('profile_candidate_id', $data['id'])->update($candidate_profile);
        } else {
            CandidateProfile::insert($candidate_profile);
        }
        return redirect('view_profile');
    }

    function view_profile(Request $request) {
        $data = $request->session()->all();
        $candidate_profile = CandidateProfile::where('profile_candidate_id', $data['id'])->first();
//        print_r($candidate_profile->toArray());exit;
//        \DB::enableQueryLog();
        $pm_experience = \DB::table('pm_experience')->where('id', $candidate_profile['pm_experiance_in_years'])->first();
        $arr_domains = explode(',',$candidate_profile['domains_id']);
        $domains = \DB::table('domains')->whereIn('id', $arr_domains)->get();
        $arr_interest = explode(',',$candidate_profile['pm_id']);
        $interest_in = \DB::table('product_management_type')->whereIn('id', $arr_interest)->get();
        return view('frontend.candidate_profile.display_profile', ['candidate_profile' => $candidate_profile,'domains' => $domains,'interests' => $interest_in,'pm_experience'=>$pm_experience]);
    }

}
