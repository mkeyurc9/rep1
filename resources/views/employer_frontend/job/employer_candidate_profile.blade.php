@include('layouts.app')
<script src="{{asset("/plugins/jquery-validation/js/jquery.validate.min.js")}}" type="text/javascript"></script>
<script src="{{asset("/plugins/jquery-validation/js/additional-methods.min.js")}}" type="text/javascript"></script>
<div class="row">
    <div class="portlet-body">
        <form method="post" class="form-horizontal" id="candidate_profile_add" action="{{url('update_employer_candidate_profile/'.$mat_algo['id'])}}" enctype="multipart/form-data" files=true>
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
                    <label class="control-label col-md-3">Candidate Name
                    </label>
                    <div class="radio">
                        <label>{{$mat_algo['candidate_signup'][0]['firstname']." ".$mat_algo['candidate_signup'][0]['lastname']}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Status
                    </label>
                    <div class="radio">
                        <label>@if($mat_algo['candidate_status']=='A' && $mat_algo['employer_status']=='P') Pending for Review @elseif($mat_algo['candidate_status']=='A' && $mat_algo['employer_status']=='A') Active @elseif($mat_algo['candidate_status']=='D' && $mat_algo['employer_status']=='D') Processed @elseif($mat_algo['candidate_status']=='D' && $mat_algo['employer_status']=='S') Successfull @else Rejected @endif</label>
                    </div>
                </div>
                @if(($mat_algo['candidate_status']=='A' && $mat_algo['employer_status']=='P')||($mat_algo['candidate_status']=='A' && $mat_algo['employer_status']=='A'))
                <div class="form-group">
                    <label class="control-label col-md-3">Interested to proceed with interview ?</label>
                    <div class="col-md-4">
                    <select class="form-control" name="employer_status" id="candidate_status">
                        <option value="">--Select--</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>             
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-md-3">Resume
                    </label>
                    <div class="col-md-4">
                        <label></label>
                    </div>
                </div>
                @if(($mat_algo['candidate_status']=='A' && $mat_algo['employer_status']=='P')||($mat_algo['candidate_status']=='A' && $mat_algo['employer_status']=='A')) 
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="cmdSubmit" value="submit" class="btn green">Submit</button>
                        </div>
                    </div>
                </div>
               @endif
            </div>
             <input type="hidden" name="candidate_satus" value="{{$mat_algo['candidate_status']}}">
             <input type="hidden" name="employer_satus" value="{{$mat_algo['employer_status']}}">
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
                employer_status:{
                    required:true,
                }
            }
        });
    });

</script>