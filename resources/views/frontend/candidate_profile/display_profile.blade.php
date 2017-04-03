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
                        <label> @if($candidate_profile['peofile_status']== 'A') Active @else Deactivate @endif</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Actively looking 
                    </label>
                    <div class="radio">
                        <label> @if($candidate_profile['actively_looking']== 1) Yes @else No @endif</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Interested in
                    </label>
                    <div>
                        @foreach($pm_experiences as $interest)
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
                        <label>{{$pm_experience->name}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Job level
                    </label>
                    <div class="radio">
                        <label>{{$candidate_profile['job_level']}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Expected Base Salary Per annum in USD
                    </label>
                    <div class="col-md-4">
                        {{$candidate_profile['expected_salary']}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Domains
                    </label>
                    <div class="checbox col-md-8">
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
                    <div class="col-md-4">
                        {{$candidate_profile['exclude_companies']}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Authorized to work in US
                    </label>
                    <div class="radio">
                        <label> @if($candidate_profile['authorized_to_work_in_us']== 1) Yes @else No @endif</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Need Sponsorship for employment Visa status
                    </label>
                    <div class="radio">
                        <label> @if($candidate_profile['need_sponsorship']== 1) Yes @else No @endif</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Relocation required ?
                    </label>
                    <div class="radio">
                        <label> @if($candidate_profile['relocation_required']== 1) Yes @else No @endif</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Willing to relocate ?
                    </label>
                    <div class="radio">
                        <label> @if($candidate_profile['willing_to_relocate']== 1) Yes @else No @endif</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Status
                    </label>
                    <div class="radio">
                        <label>{{$candidate_profile['status']}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Resume
                    </label>
                    <div class="col-md-4">
                        <a href="{{ asset('/upload_resume/'.$candidate_profile['resume'])}}" target="_blank">View Resume</a>
                    </div>
                </div>
            </div>
        </form> 

    </div>
</div>