<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Model\MatchingAlgo as MatchingAlgo;

class MatchingAlgoController extends Controller {

    function index(Request $request) {
        $data = $request->session()->all();

        if (request()->ajax()) {
            $html = '';
            $candidate_status = $request->input('cur');
            if ($candidate_status == 'C') {
                $matching_algo = MatchingAlgo::where('candidate_id', $data['id'])->with('employer_signup')->paginate(10);
            } else if ($candidate_status == 'PA') {
                $matching_algo = MatchingAlgo::where('candidate_id', $data['id'])
                                               ->where(function ($query) {
                                                 $query->where('candidate_status', '=', 'A')
                                                        ->orWhere('candidate_status', '=', 'P');
                                                })
                                               ->with('employer_signup')->paginate(50);
            } else {
                $matching_algo = MatchingAlgo::where('candidate_id', $data['id'])
                                ->where('candidate_status', $candidate_status)
                                ->with('employer_signup')->paginate(50);
            }
            if ($matching_algo->toArray()['total'] == 0) {
                $html .= '<tr><td>No Matching Jobs Available</td></tr>';
            } else {
                foreach ($matching_algo as $mat_algo) {
                    $html .='<tr>';
                    $html .='<td><a href="' . url("display_job_description/" . $mat_algo['job_id']) . '">' . $mat_algo['employer_signup']->company_name . '</a></td>';
                    if ($mat_algo['candidate_status'] == 'P') {
                        $html .='<td>Pending</td>';
                    } else if ($mat_algo['candidate_status'] == 'A') {
                        $html .='<td>Active</td>';
                    } else if ($mat_algo['candidate_status'] == 'N') {
                        $html .='<td>Null</td>';
                    } else {
                        $html .='<td>Processed</td>';
                    }
                    $html .='</tr>';
                }
            }
            return $html;
        } else {

            $matching_algo = MatchingAlgo::where('candidate_id', $data['id'])->with('employer_signup')->paginate(10);
        }
        return view('frontend.matching_algo.index', ['matching_algo' => $matching_algo]);
    }

    function job_description(Request $request, $id) {
        $data = $request->session()->all();
        $matching_algo = MatchingAlgo::where(['job_id'=>$id,'candidate_id'=>$data['id']])
                                  ->with('employer_signup')->first();
        $job_description = \DB::table('job_details')->where('id', $id)->first();
        return view('frontend.matching_algo.job_description', ['mat_algo' => $matching_algo, 'job_description' => $job_description]);
    }

    function update_candidate_job_status(Request $req, $id) {
        $this->validate($req, [
            'candidate_status' => 'required'
        ]);
        $status = $req['candidate_status'];
        if ($status == 1) {
            $data['candidate_status'] = 'A';
            $data['employer_status'] = 'P';
        } else {
            $data['candidate_status'] = 'D';
        }
        MatchingAlgo::where('id', $id)->update($data);
        return redirect('view_matched_jobs');
    }

}
