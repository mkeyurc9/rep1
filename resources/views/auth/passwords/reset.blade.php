@include('layouts.app')
<script src="{{asset("/public/plugins/jquery-validation/js/jquery.validate.min.js")}}" type="text/javascript"></script>
<script src="{{asset("/public/plugins/jquery-validation/js/additional-methods.min.js")}}" type="text/javascript"></script>
<div class="row">
    <div class="portlet-body">
        <form method="post" class="form-horizontal" id="admin_login" action="{{ url('password_update') }}">
            {{ csrf_field() }}
            <div class="form-body">
                <div style="width:40%;margin-bottom: 20px; text-align: center;">
                    @if(Session::has('message'))
                    {{Session::get('message')}}
                    @endif
                </div>
               @if(!empty($user))
                <div class="form-group">
                    <label class="control-label col-md-3">Password
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input name="password" value="" id="password" type="password" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"> Confirm Password
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input name="c_password" value="" type="password" class="form-control" />
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="cmdSubmit" value="submit" class="btn green">Set Password</button>
                            <a href="{{url('view_login')}}" class="btn grey-salsa btn-outline">Cancel</a>
                        </div>
                    </div>
                </div>
                    <input name="id" value="{{$id}}" type="hidden" class="form-control" />
                    <input name="a_token" value="{{$token}}" type="hidden" class="form-control" />
                    <input name="type" value="{{$type}}" type="hidden" class="form-control" />
            </div>
            @else
                <div style="width:40%;margin-bottom: 20px; text-align: center;">            
                    <p>Invalid Forgot password link</p>
                </div>
            @endif
        </form> 
           
    </div>
</div>
<script>
$(document).ready(function () {
    $('#admin_login').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "", // validate all fields including form hidden input
        rules: {
            password: {
                required: true
            },
            c_password: {
                required: true,
                equalTo:"#password"
            }
        },
        messages: {
             password: {
                required: "Please Enter password"
            },
            c_password: {
                required: "Please Enter confirm password",
                equalTo: "The Confirm Password field does not match the Password field."
            },
        }
    });
});
</script>
