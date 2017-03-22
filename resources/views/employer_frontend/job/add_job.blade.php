@include('layouts.app')
<script src="{{asset("/plugins/jquery-validation/js/jquery.validate.min.js")}}" type="text/javascript"></script>
<script src="{{asset("/plugins/jquery-validation/js/additional-methods.min.js")}}" type="text/javascript"></script>
<div class="row">
    <div class="portlet-body">
        <form method="post" class="form-horizontal" id="frm_job_add" action="{{url('store_job')}}">
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
                    <label class="control-label col-md-3">Withdraw Job Submission
                    </label>
                    <div class="radio">
                        <label><input type="radio" name="withdraw_job_submission" value="1">Yes</label>
                        <label><input type="radio" name="withdraw_job_submission" value="0" checked>No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Job Title
                    </label>
                    <div class="col-md-4">
                        <input name="job_title" value="" type="text" id="job_title" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Job Location
                    </label>
                    <div class="col-md-4">
                        <input name="job_location" value="" type="text" id="job_location" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Job Type
                    </label>
                    <div>
                        <div class="checbox">
                            @foreach($product_management_type as $pm)
                                @php
                                    $checked='';
                                @endphp
                              
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="job_type[]" value="{{$pm->id}}">{{$pm->name}}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Job level
                    </label>
                    <div class="radio">
                        <label><input type="radio" name="job_level"  value="entry" checked>Entry</label>
                        <label><input type="radio" name="job_level" value="mid_level" >Mid-level</label>
                        <label><input type="radio" name="job_level" value="senior_level" >Senior level</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Annual Salary range in USD</label>
                    <div class="col-md-4">
                        <select class="form-control" name="annual_salary" id="annual_salary">
                            <option value="">--Select--</option>
                            <option value="60000-1000000">60000-100000</option>
                            <option value="60000-1250000">60000-125000</option>
                            <option value="125000-150000">125000-150000</option>
                            <option value="150000+">150000+</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Preferred Domain experience
                    </label>
                    <div class="checbox col-md-8">
                        @foreach($domains as $domain)
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="domains[]" value="{{$domain->id}}">{{$domain->name}}
                                </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Job Description
                    </label>
                    <div class="col-md-4">
                        <textarea name="job_description" id="job_description" class="form-control" /></textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="cmdSubmit" value="submit" class="btn green">Submit</button>
                            <a href="{{url('/home')}}" class="btn grey-salsa btn-outline">Cancel</a>
                        </div>
                    </div>
                </div>

            </div>
        </form> 

    </div>
</div>
<script>

$(document).ready(function ()
{
    $('#frm_job_add').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "", // validate all fields including form hidden input
        rules: {
            job_title: {
                required: true
            },
            job_location: {
                required: true
            },
            "job_type[]":{
                required: true,
                minlength: 1
            },
            annual_salary: {
                required: true
            },
            "domains[]": {
                    required: true, 
                    minlength: 1 
            },
            job_description: {
                required: true,
            }
        }
    });
});

</script>