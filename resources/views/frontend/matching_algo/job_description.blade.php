@include('layouts.app')
<script src="{{asset("/public/plugins/jquery-validation/js/jquery.validate.min.js")}}" type="text/javascript"></script>
<script src="{{asset("/public/plugins/jquery-validation/js/additional-methods.min.js")}}" type="text/javascript"></script>
<div class="row">
    <div class="portlet-body">
        <form method="post" class="form-horizontal" id="candidate_profile_add" action="{{url('update_candidate_job_status/'.$mat_algo['id'])}}" enctype="multipart/form-data" files=true>
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
                    <label class="control-label col-md-3">Company Name
                    </label>
                    <div class="radio">
                        <label>{{$mat_algo['employer_signup']->company_name}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Status
                    </label>
                    <div class="radio">
                        <label>@if($mat_algo['candidate_status']=='P') Pending @elseif($mat_algo['candidate_status']=='N') Null @elseif($mat_algo['candidate_status']=='A') Active @else Processed @endif</label>
                    </div>
                </div>
                @if($mat_algo['candidate_status']=='P')
                <div class="form-group">
                    <label class="control-label col-md-3">Interested to proceed with interview ?</label>
                    <div class="col-md-4">
                    <select class="form-control" name="candidate_status" id="candidate_status">
                        <option value="">--Select--</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>             
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-md-3">Job Description
                    </label>
                    <div class="col-md-4">
                        <label>{{$job_description->description}}</label>
                    </div>
                </div>
                @if($mat_algo['candidate_status']=='P') 
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="cmdSubmit" value="submit" class="btn green">Submit</button>
                        </div>
                    </div>
                </div>
               @endif
            </div>
        </form> 

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
                candidate_status:{
                    required:true,
                }
            }
        });
    });

</script>