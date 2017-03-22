<?php

namespace App\Http\Controllers\employer_frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class JobController extends Controller
{
    function create(Request $req){
        $domains = \DB::table('domains')->get(['name', 'id']);
        $product_management_type = \DB::table('product_management_type')->get(['name', 'id']); 
        
       return view('employer_frontend.job.add_job',['domains' => $domains, 'product_management_type' => $product_management_type]);
    }
}
