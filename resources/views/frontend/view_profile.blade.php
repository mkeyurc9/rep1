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
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">Actively looking 
                    </label>
                    <div class="radio">
                        <label><input type="radio" name="actively_looking" value="1" checked>Yes</label>
                        <label><input type="radio" name="actively_looking" value="0">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Interested in
                    </label>
                    <div>
                        <div class="checbox">
                            @foreach($product_management_type as $pm)
                            <label class="checkbox-inline">
                                <input type="checkbox" name="interest_in[]" value="{{$pm->id}}">{{$pm->name}}
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">PM experience in years
                    </label>
                    <div class="radio">
                        <label><input type="radio" value="0-1" name="pm_experience_in_years" checked>0-1</label>
                        <label><input type="radio" value="1-2" name="pm_experience_in_years">1-2</label>
                        <label><input type="radio" value="2-4" name="pm_experience_in_years">2-4</label>
                        <label><input type="radio" value="4+" name="pm_experience_in_years">4+</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Job level
                    </label>
                    <div class="radio">
                        <label><input type="radio" name="job_level"  value="entry" checked>Entry</label>
                        <label><input type="radio" name="job_level" value="mid_level">Mid-level</label>
                        <label><input type="radio" name="job_level" value="senior_level">Senior level</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Expected Base Salary Per annum in USD
                    </label>
                    <div class="col-md-4">
                        <input name="expected_salary"  type="text" id="expected_salary" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Domains
                    </label>
                    <div class="checbox col-md-8">
                        @foreach($domains as $domain)
                        <label class="checkbox-inline">
                            <input type="checkbox" name="domains[]" value="{{$domain->id}}">{{$domain->name}}
                        </label>
                        @endforeach
                    </div>
                </div>
               
<script>

$(document).ready(function ()
{
    $('#candidate_profile_add').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "", // validate all fields including form hidden input
        rules: {
            expected_salary: {
                required: true,
                number: true

            },
            resume:{
                    required:true,
                    extension: "png|jpg|jpeg|gif"
                    },
            exclude_company: {
                required: true,
            }
        },
        messages: {
            expected_salary: {
                required: "Please Enter Expected Base Salary Per annum in USD ",
                number: "Decimal Numbers Only"
            },
            exclude_company: {required: "Please Enter Exclude Companies"},
        }
    });
});

</script>