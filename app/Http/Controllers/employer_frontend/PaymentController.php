<?php

namespace App\Http\Controllers\employer_frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class PaymentController extends Controller
{
	public function getlist()
	{
            $employer_id = Session('id');


            $condition=array(
                              'payment_complete'=>0,
                              'payment_base.employer_id'=>$employer_id,
                              );
            
		$users = DB::table('payment_base')
            ->join('candidate_signup', 'candidate_signup.candidate_id', '=', 'payment_base.candidate_id')

            ->join('matching_algo_status', 'matching_algo_status.id', '=', 'payment_base.matching_algo_status_id')


            ->select('candidate_signup.firstname as c_F',
                  'candidate_signup.lastname as c_L',
                  'payment_base.total_payment as payment',
                  'matching_algo_status.updated_at as hiredate',
                  'payment_base.id as payment_base_id',
                  'payment_base.employer_id as empid',
                  'payment_base.candidate_id as candidid',
                  'payment_base.job_id as jobid',
                  'payment_base.payment_setting as paymentsetting'

             )
            ->WHERE($condition)
            ->orderBy('candidate_signup.candidate_id', 'asc')
            ->Paginate(10);
            // return $users;

		return view('employer_frontend/payment/candidate_for_payment',['users'=>$users]);
	}
      public function getremainfees($payment_base_id,$payment)
      {

            $condition=array(
                              'payment_base_id'=>$payment_base_id
                              );
            $data = DB::table("payment_made")->where($condition)->sum('paid');
            return $data;

      }

      public function getpaymentcount($payment_base_id)
      {
            $condition=array(
                              'payment_base_id'=>$payment_base_id
                              );
            $payment_made = DB::table('payment_made')->WHERE($condition)->count();
            return $payment_made;

      }
      public function gegidpaypmentprepocessing()
      {
            return DB::table('payment_preprocessing')->orderBy('id', 'desc')->first();
      }
}
	