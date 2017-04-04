@extends('layouts.app')
@section('content')
<style>
    .div {
        margin-top: 20px;
    }

    .sign_up_main {

    }

    .sign_up_wrap {
        width:100%;
        text-align: center;
        margin-top: 10px;
        padding: 0px 20px 0px 20px;
        font-weight: bold;
        font-size: 24px;
    }

    .sign_up_link_wrap {
        width:100%;
        text-align: center;
        padding:0px;
        font-weight: bold;
        clear:both;
    }

    .sign_up_links {
        width:50%;
        text-align: center;
        margin-top: 20px;
        padding:5px;
        font-weight: bold;
        font-size: 16px;
        float:left;
    }

    .about_us_main,
    .workflow_main {
        width:100%;
        margin-top: 60px;
        margin-bottom: 20px;
    }

    .workflow_main {
        margin-top: 10px;
    }

    .about_us_wrap,
    .workflow_wrap {
        width:100%;
        padding:20px 20px 0px 40px;
        font-weight: bold;
        font-size: 24px;
    }

    .about_us_subcontent {
        margin-left: 20px;
        margin-top: 20px;
    }

    .about_us_subcontent span {
        font-weight: bold;
        padding-left: 20px;
    }

    .about_us_data {
        padding-left: 20px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="workflow_wrap">
                @if(Session::has('message'))
                {{Session::get('message')}}
                @endif
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><img src="{{asset("uploads/exedra.jpg")}}" style="width:100%"></div>
                <div class="sign_up_main">
                    <div class="sign_up_wrap" id="sign-up">Sign Up</div>
                    <div class="sign_up_link_wrap">
                        <div class="sign_up_links" >@if(empty(Session::has('email')))<a href="{{url('candidate/register')}}">Candidate</a> @else Candidate @endif</div>
                        <div class="sign_up_links">@if(empty(Session::has('email')))<a href="{{url('employer/register')}}">Employer</a>@else Employer @endif</div>
                    </div>

                </div>

                <div class="about_us_main" id="about-us">
                    <div class="about_us_wrap">About Us</div>
                    <div class="about_us_content">
                        <div class="about_us_subcontent">
                            <span>Why?</span><br/> 
                            <span>Personal Focus</span><br/>
                            <div class="about_us_data">We personally ensure that both candidates and employers are able to leverage this common platform to interact to fullest.</div>
                        </div>

                        <div class="about_us_subcontent">
                            <span>Specialization</span><br/>
                            <div class="about_us_data">We ensure that we understand both candidate and employers goals and there are no compromises.</div>
                        </div>

                        <div class="about_us_subcontent">
                            <span>Pricing</span><br/>
                            <div class="about_us_data">This platform is free for all candidates and employers pay fixed pricing for all levels.</div>
                        </div>

                    </div>

                </div>

                <div class="workflow_main" id="work-flow">
                    <div class="workflow_wrap">How it works</div>
                    <div class="about_us_content">
                        <div class="about_us_subcontent">
                            <div class="about_us_data">Candidates submit their profile. After close interaction with them, we apply our algorithm to find their dream job. We thus provide platform for candidates and employers to facilitate achieving their goals. 

                                <br/><br/>We feel there is always a <strong>Right job</strong> for a <strong>Right Candidate</strong> and our goal is to make your next job a step towards achieving your goal.</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
