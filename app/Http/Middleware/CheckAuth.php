<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Candidate as Candidate;
use App\Model\Employer as Employer;


class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $loggedutype)
    { 
       $email = session('email');
       $user_type = session('user_type');
       if(!empty($email) && $user_type == $loggedutype){
           return $next($request);
       } 
       return redirect('view_login');
    }
}
