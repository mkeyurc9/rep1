Hey {{$firstname.' '.$lastname}}, Welcome to our website. <br>
Please click <a href="{!! url('employer_register/verify', ['code'=>$activation_token]) !!}"> Here</a> to confirm email