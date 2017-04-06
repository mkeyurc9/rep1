@include('layouts.app')
<style>
    .gameplay-baseball-field {
        margin-left: 341px;
    }
</style>
<script src="{{asset("/plugins/jquery-validation/js/jquery.validate.min.js")}}" type="text/javascript"></script>
<script src="{{asset("/plugins/jquery-validation/js/additional-methods.min.js")}}" type="text/javascript"></script>
<div class="row">
    <div class="portlet-body">
        <form method="post" class="form-horizontal" id="candidate_profile_add" action="{{url('insert_candidate_profile')}}" enctype="multipart/form-data" files=true>
            {{ csrf_field() }}
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">Profile Status
                    </label>
                    <div class="radio">
                         @if($candidate_profile['profile_status']=='A') Active @else Deactivate @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Actively looking 
                    </label>
                    <div class="radio">
                         @if($candidate_profile['actively_looking']== 1) Yes @else No @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Interested in
                    </label>
                    <div class="radio">
                        @foreach($interests as $interest)
                        {{$interest->name}}
                        @if (!$loop->last)
                        {{ '&nbsp;&nbsp;|&nbsp;&nbsp;' }}
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">PM experience in years
                    </label>
                    <div class="radio">
                        {{$pm_experience->name}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Job level
                    </label>
                    <div class="radio">
                        {{ucfirst($candidate_profile['job_level'])}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Expected Base Salary Per annum in USD
                    </label>
                    <div class="radio">
                        {{$candidate_profile['expected_salary']}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Domains
                    </label>
                    <div class="radio">
                        @foreach($domains as $domain)
                        {{$domain->name}}
                         @if (!$loop->last)
                        {{ '&nbsp;&nbsp;|&nbsp;&nbsp;' }}
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Exclude Companies
                    </label>
                    <div class="radio">
                        @if(!empty($candidate_profile['exclude_companies']))
                        {{$candidate_profile['exclude_companies']}}
                        @else
                        {{"N/A"}}
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Authorized to work in US
                    </label>
                    <div class="radio">
                        @if($candidate_profile['authorized_to_work_in_us']== 1) Yes @else No @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Need Sponsorship for employment Visa status
                    </label>
                    <div class="radio">
                        @if($candidate_profile['need_sponsorship']== 1) Yes @else No @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Relocation required ?
                    </label>
                    <div class="radio">
                        @if($candidate_profile['relocation_required']== 1) Yes @else No @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Willing to relocate ?
                    </label>
                    <div class="radio">
                        @if($candidate_profile['willing_to_relocate']== 1) Yes @else No @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Status
                    </label>
                    <div class="radio">
                        {{ucfirst($candidate_profile['status'])}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Resume
                    </label>
                    <div class="radio">
                        <a href="{{ asset('/upload_resume/'.$candidate_profile['resume'])}}" target="_blank">View Resume</a>
                    </div>
                </div>
            </div>
        </form> 

    </div>
</div>