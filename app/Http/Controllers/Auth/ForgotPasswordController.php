<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Model\Candidate as Candidate;
use App\Model\Employer as Employer;
use App\User;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
     public function sendResetLinkEmail(Request $request)
    {
      $this->validate($request,[
          'email'=>'required'
      ]);
      
      $email = $request->input('email');
      $c_data = Candidate::where('email',$email)->first();
      $e_data = Employer::where('email',$email)->first();

      //changes for admin reset password

      $u_data = User::where('email',$email)->first();

      $template = 'auth/emails.password';
      $data['token'] = $token = str_random(40);
      $data['email'] = $email;
      $data['msg'] = "Forgot Password Link";
      if($c_data){     
            $data['id'] = $c_data->candidate_id;
            $data['firstname'] = $c_data->firstname;
            $data['lastname'] = $c_data->lastname;
            $data['type'] = 'candidate';
            send_email($data,$template);
            Candidate::where('candidate_id', $data['id'])->update(['token'=>$token]);
            Session::flash('message', 'Send Forgot password Link to your email');
            return redirect('view_login');
      }
      elseif($e_data)
      {       
            $data['id'] = $e_data->employer_id;
            $data['firstname'] = $e_data->firstname;
            $data['lastname'] = $e_data->lastname;
            $data['type'] = 'employer';
            send_email($data,$template);
            Employer::where('employer_id', $data['id'])->update(['token'=>$token]);
            Session::flash('message', 'Send Forgot password Link to your email');
            return redirect('view_login');
      }
      elseif($u_data)
      {
            $data['id'] = $u_data->id;
            $data['firstname'] = $u_data->name;
            $data['lastname'] = '';
            $data['type'] = 'admin';
            send_email($data,$template);
            User::where('id', $data['id'])->update(['remember_token'=>$token]);
            Session::flash('message', 'Send Forgot password Link to your email');
            return redirect('admin/login');
      }
    }
    
    function reset_password($type,$id,$token){
      if($type=='candidate'){
           $user=Candidate::where('candidate_id',$id)
                     ->where('token',$token)
                     ->first();
      } 
      elseif($type=='employer')
      {
           $user=Employer::where('employer_id',$id)
                    ->where('token',$token)
                    ->first();
      } 
      elseif($type=='admin')
      {
        $user=User::where('id',$id)
                    ->where('remember_token',$token)
                    ->first();
      }
      return view('auth.passwords.reset',['type'=>$type,'token'=>$token,'id'=>$id,'user'=>$user]); 
    }
    function password_update(Request $request){
       $password = md5($request->input('password'));
       $id = $request->input('id'); 
       $token = $request->input('a_token'); 
       if($request->input('type')=='candidate'){
           Candidate::where('candidate_id',$id)
                     ->where('token',$token)
                     ->update(['token'=>NULL,'password'=>$password]);
       }
       elseif($request->input('type')=='employer')
       {  
           Employer::where('employer_id',$id)
                    ->where('token',$token)
                    ->update(['token'=>NULL,'password'=>$password]);
       }
      elseif($request->input('type')=='admin')
       {  
           User::where('id',$id)
           ->where('remember_token',$token)
                    ->update(['remember_token'=>NULL,'password'=>$password]);
       }
       Session::flash('message', 'Password updated Successfully');
       return redirect('/');

}
}
