<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/','HomeController@index');
Route::auth();

Route::get('candidate/register','Auth\RegisterController@candidate_register');
Route::post('candidate/sign_up','Auth\RegisterController@candidate_insert_data');
Route::get('candidate_register/verify/{token}','Auth\RegisterController@confirm_registration_candidate');

Route::get('employer/register','Auth\RegisterController@employer_register');
Route::post('employer/sign_up','Auth\RegisterController@employer_insert_data');
Route::get('employer_register/verify/{token}','Auth\RegisterController@confirm_registration_employer');


Route::get('admin/register','Auth\RegisterController@admin_register');
// Route::post('employer/sign_up','Auth\RegisterController@employer_insert_data');
// Route::get('employer_register/verify/{token}','Auth\RegisterController@confirm_registration_employer');




Route::get('view_login','Auth\RegisterController@view_login');
//changes
Route::get('admin/login','Auth\RegisterController@admin_login');
Route::post('admin_panel_login','Auth\RegisterController@admin_panel_login');
///////
Route::post('user_login','Auth\RegisterController@user_login');
Route::get('set_password/{type}/{id}/{token}','Auth\ForgotPasswordController@reset_password');
Route::post('password_update','Auth\ForgotPasswordController@password_update');

Route::group(['middleware'=>['checkAuth:candidate']],function(){
    Route::get('edit_profile','frontend\ProfileController@index');
    Route::post('insert_candidate_profile','frontend\ProfileController@create');
    Route::get('view_profile','frontend\ProfileController@view_profile');
    Route::get('view_matched_jobs','frontend\MatchingAlgoController@index');
    Route::get('display_job_description/{id}','frontend\MatchingAlgoController@job_description');
    Route::post('update_candidate_job_status/{id}','frontend\MatchingAlgoController@update_candidate_job_status');
});

Route::group(['middleware'=>['checkAuth:employer']],function(){
    Route::get('add_job','employer_frontend\JobController@create');
    Route::post('store_job','employer_frontend\JobController@store_job');
    Route::get('view_add_job','employer_frontend\JobController@view_add_job');
    Route::get('edit_job/{id}','employer_frontend\JobController@edit_job');
    Route::post('update_job/{id}','employer_frontend\JobController@update_job');
    Route::get('view_employer_job/{id}','employer_frontend\JobController@view_employer_job');
    Route::get('employer_candidate_profile/{id}','employer_frontend\JobController@employer_candidate_profile');
    Route::post('update_employer_candidate_profile/{id}','employer_frontend\JobController@update_employer_candidate_profile');
});

//for the admin panel 

Route::group(['middleware'=>['checkAuth:admin']],function(){
      Route::get('admin', function () {
    return view('jobzerda_admin/admin_template');
});
    Route::get('admin/list_canditate','admin_frontend\backendController@getuser');
    Route::get('admin/filter_canditate','admin_frontend\backendController@filter_user');
});
    


 Route::get('user_logout','Auth\RegisterController@user_logout');
 Route::get('matchcron','MatchController@matchcron');


 //for static page

  Route::get('terms',function(){
    return view('static.termsandcondition');
  });

  Route::get('policy',function(){
    return view('static.policy');
  });
