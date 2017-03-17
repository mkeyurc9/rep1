<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Model\Domains as Domain;

class ProfileController extends Controller
{
    /**
     * 
     * index
     * 
     * used to show view profile
     * @return Response
     */
    function index(){
       $domains = \DB::table('domains')->get(['name','id']);
       $product_management_type = \DB::table('product_management_type')->get(['name','id']);
       return view('frontend.view_profile',['domains'=>$domains, 'product_management_type'=>$product_management_type]); 
    }
}
