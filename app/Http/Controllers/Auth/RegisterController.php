<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Input;
use Illuminate\Http\Request;
use App\Model\Candidate as Candidate;
use App\Model\Employer as Employer;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    /**
   *candidate_register
   * 
   *Show the form to create a Candidate.
   * 
   * @return Response
   */
    public function candidate_register() {
        return view('auth.candidate_register');
    }
   /**
    * candidate_insert_data
    * 
    * Store a new candidate data.
    * @param Request $request
    * @return type
    */
    public function candidate_insert_data(Request $request) {
        $this->validate($request, [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|unique:candidate_signup,email|unique:employer_signup,email',
            'phone_number' => 'required|max:20|min:7',
            'password' => 'required|min:8|max:30|alpha_num',
            'confirm_password' => 'required|same:password'
        ]);
        $candidate = array();
        $candidate['firstname'] = $request->input('firstname');
        $candidate['lastname'] = $request->input('lastname');
        $candidate['email'] = $request->input('email');
        $candidate['phone_number'] = $request->input('phone_number');
        $candidate['password'] = md5($request->input('password'));
        $candidate['created_at'] = date('Y-m-d H:i:s');
        $candidate['updated_at'] = date('Y-m-d H:i:s');
        $candidate['activation_token'] = str_random(40);
        
        Candidate::insert($candidate);
        Session::flash('message', 'Candidate created Successfully!!');
        $template = 'auth/emails.candidate_verification';
        $candidate['msg'] = "Welcome to JobZedra";
        send_email($candidate,$template);
        return redirect('/');
    }
  /**
   * 
   * confirm_registration_candidate
   * 
   * use to confirmation of email
   * @param string $activation_token
   * @return Response
   */
    function confirm_registration_candidate($activation_token) {
        if (!$activation_token) {
            Session::flash('message', 'Activation Code is Blank');

            return redirect('/');
        }

        $candidate = Candidate::where('activation_token', $activation_token)->first();

        if (!$candidate) {
             Session::flash('message', 'Already verified. Please Login to continue');

            return redirect('/');
        }

        $data = array();
        $data['activation_token'] = null;
        $data['is_activated'] = 1;
        Candidate::where('activation_token',$activation_token)->update($data);

        Session::flash('message', 'You have successfully verified your account.');

        return redirect('/');
    }
  /**
   *employer_register
   * 
   *Show the form to create a Employer.
   * 
   * @return Response
   */
    public function employer_register() {
        return view('auth.employer_register');
    }
    /**
    * employer_insert_data
    * 
    * Store a new employer data.
    * @param Request $request
    * @return Response
    */
    public function employer_insert_data(Request $request) {
        $this->validate($request, [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|unique:candidate_signup,email|unique:employer_signup,email',
            'phone_number' => 'required|max:20|min:7',
            'password' => 'required|min:8|max:30|alpha_num',
            'confirm_password' => 'required|same:password',
            'company_name' => 'required'
        ]);
        $employer = array();
        $employer['firstname'] = $request->input('firstname');
        $employer['lastname'] = $request->input('lastname');
        $employer['email'] = $request->input('email');
        $employer['phone_number'] = $request->input('phone_number');
        $employer['password'] = md5($request->input('password'));
        $employer['company_name'] = $request->input('company_name');
        $employer['company_url'] = $request->input('company_url');
        $employer['created_at'] = date('Y-m-d H:i:s');
        $employer['updated_at'] = date('Y-m-d H:i:s');
       
        $employer['activation_token'] = str_random(40);
        Employer::insert($employer);
        Session::flash('message', 'Employer created Successfully!!');
        $template = 'auth/emails.employer_verification';
        $employer['msg'] = "Welcome to JobZedra";
        send_email($employer,$template);
        return redirect('/');
    }
    
     /**
   * 
   * confirm_registration_employer
   * 
   * use to confirmation of email
   * @param string $activation_token
   * @return Response
   */
    function confirm_registration_employer($activation_token) {
        if (!$activation_token) {
            Session::flash('message', 'Activation Code is Blank');

            return redirect('/');
        }

        $employer = Employer::where('activation_token', $activation_token)->first();

        if (!$employer) {
             Session::flash('message', 'Already verified. Please Login to continue');

            return redirect('/');
        }

        $data = array();
        $data['activation_token'] = null;
        $data['is_activated'] = 1;
        Employer::where('activation_token',$activation_token)->update($data);

        Session::flash('message', 'You have successfully verified your account.');

        return redirect('/');
    }

    //for the admin_login
    //chagnes for admin panel
        function admin_login(){
        return view('jobzerda_admin.admin_login');
    }

    function admin_panel_login(Request $request)
    {
        $email = $request->input('email');
        $password = md5($request->input('password'));
//        \DB::enableQueryLog();

        $user=User::where(['email' => $email,'password' => $password])->first();
        if(!$user) 
        {
            Session::flash('message', 'Invalid Email/Password');
                    return redirect('admin/login');
        }
        else 
        {   
                    //employer session
            session(['email'=> $email,'id'=>$user['id'], 'user_type'=> 'admin']);
                 return redirect('admin');
        }
   
    }
    /**
    *view_login
    * 
    *Show the form to  Login.
    * 
    * @return Response
   */
    function view_login(){
        return view('auth.login');
    }
    
    function user_login(Request $request){
        $email = $request->input('email');
        $password = md5($request->input('password'));
//        \DB::enableQueryLog();
        $candidate = Candidate::where(['email' => $email,'password' => $password, 'is_activated' => '1'])->first();
//        print_r(\DB::getQueryLog());exit;
        if(!$candidate){
            $employer = Employer::where(['email' => $email,'password' => $password, 'is_activated' => '1'])->first();
            if(!$employer) {
                Session::flash('message', 'Invalid Email/Password OR Inactive Account. Please check your email if you have already signed up to activate your account');
                return redirect('login');
            }else {
                //employer session
                session(['email'=> $email,'id'=>$employer['employer_id'], 'user_type'=> 'employer']);
            }
        }else {
            //candidate session
                session(['email'=> $email,'id'=>$candidate['candidate_id'], 'user_type'=> 'candidate']);
        }
        return redirect('/');
    }
    
    function user_logout(Request $request){
       $request->session()->flush();
       return redirect('/');
    }
}
