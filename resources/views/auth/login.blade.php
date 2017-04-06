@include('layouts.app')
<script src="{{asset("/public/plugins/jquery-validation/js/jquery.validate.min.js")}}" type="text/javascript"></script>
<script src="{{asset("/public/plugins/jquery-validation/js/additional-methods.min.js")}}" type="text/javascript"></script>
<style>
    .shift_left{
        margin-left:665px;
    }
    .session_left{
        width:40%;margin-bottom: 20px; text-align: center;
    }
</style>
<div class="row">
    <div class="portlet-body">
        <form method="post" class="form-horizontal" id="login" action="{{url('user_login')}}">
            {{ csrf_field() }}
            <div class="form-body">
                <div class="session_left">
                @if(Session::has('message'))
                {{Session::get('message')}}
                @endif
              </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Email
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input name="email"  value="{{old('email')}}" type="text" class="form-control" />
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
                <div class="fa-align shift_left" ><a href="{{url('/password/reset')}}">Forgot Password</a></div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="cmdSubmit" value="submit" class="btn green">Submit</button>
                            <a href="{{url('/')}}" class="btn grey-salsa btn-outline">Cancel</a>
                        </div>
                    </div>
                </div>

            </div>
        </form> 

    </div>
</div>
<script>
     $(document).ready(function(){
         $('#login').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
             rules:{
                 email:{
                      required:true,
                      email:true
                 },
                 password:{
                     required:true         
                 }
             },
             messages:{
                 email:{
                     required:'This Field is required'
                 },
                 password:{
                     required:'This field is required'
                 },
             }
         });
     });
</script>
