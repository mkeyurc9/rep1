@include('layouts.app')
<script src="{{asset("/plugins/jquery-validation/js/jquery.validate.min.js")}}" type="text/javascript"></script>
<script src="{{asset("/plugins/jquery-validation/js/additional-methods.min.js")}}" type="text/javascript"></script>
<div class="row">
    <div class="portlet-body">
        <form method="post" class="form-horizontal" id="employer_add" action="{{url('employer/sign_up')}}">
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
                    <label class="control-label col-md-3">Email
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input name="email"  value="{{old('email')}}" type="text" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">First Name
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input name="firstname"  value="{{old('firstname')}}" type="text" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Last Name
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input name="lastname"  value="{{old('lastname')}}" type="text" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Phone Number
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input name="phone_number"  value="{{old('phone_number')}}" type="text" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Password
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input name="password"  type="password" id="password" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Confirm Password
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input name="confirm_password" type="password" id="confirm_password" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Company Name
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input name="company_name"  value="{{old('company_name')}}" type="text" class="form-control" />
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-3">Company URL
                        <!--<span class="required"> * </span>-->
                    </label>
                    <div class="col-md-4">
                        <input name="company_url"  value="{{old('company_url')}}" type="text" class="form-control" />
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <strong>By Signing up you agree to Terms and Privacy Policy</strong><br>
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
    $('#employer_add').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "", // validate all fields including form hidden input
        rules: {
            firstname: {
                required: true,
            },
            lastname: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            phone_number: {
                required: true
            },
            company_name:{
                required: true
            },
            company_url:{
                url: true
            },
            password: {
                required: true
            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            email: {
                required: "Please Enter email id",
                email: "Please Enter valid email",
                remote: "Email id already exists "
            },
            firstname: {required: "Please Enter First Name "},
            phone_number: {required: "Please Enter Phone number "},
            lastname: {required: "Please Enter Last Name "},
            company_name: {required:"Please Enter Company Name"},
            password: {
                required: "Please Enter password"
            },
            confirm_password: {
                required: "Please Enter confirm password",
                equalTo: "The Confirm Password field does not match the Password field."
            },
        }
    });
});

</script>
