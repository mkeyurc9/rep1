<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MatchingAlgo as MatchingAlgo;

class MatchingAlgoController extends Controller
{
    function index(Request $request){
        if(request()->ajax()){
           $candidate_status = $request->input('cur');
           $matching_algo = MatchingAlgo::where('candidate_status',$candidate_status)
                                          ->with('employer_signup')->paginate(50);
                return response()->json(["data" => $matching_algo]);
        }else{
        $matching_algo = MatchingAlgo::with('employer_signup')->paginate(50);
        }
        return view('frontend.matching_algo.index',['matching_algo'=>$matching_algo]);
    }
    function job_description(Request $request,$id){
        $matching_algo = MatchingAlgo::where('job_id',$id)
                                      ->with('employer_signup')->first();
        $job_description = \DB::table('job')->where('id',$id)->first();
        return view('frontend.matching_algo.job_description',['mat_algo'=>$matching_algo,'job_description'=>$job_description]);
    }
    function update_candidate_job_status(Request $req,$id){
        $status = $req['candidate_status'];
        if($status==1){
        $data['candidate_status'] = 'A';
        }else {
          $data['candidate_status'] = 'D';
        }
        MatchingAlgo::where('id',$id)->update($data);
        return redirect('view_matched_jobs');
    }
}
