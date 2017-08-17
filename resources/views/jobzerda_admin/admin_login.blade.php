<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "AdminLTE JobZedra" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">

        <form method="post" class="form-horizontal" id="login" action="{{url('admin_panel_login')}}">
            {{ csrf_field() }}



            <div class="login-box">
  <div class="login-logo">
    <a href=""><b>Admin</b>JobZedra</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
          @if(Session::has('message'))
          <p style="color:red;">
                {{Session::get('message')}}
          </p>
          @endif
    <form action="../../index2.html" method="post">
      <div class="form-group has-feedback">
        <input name="email"  value="{{old('email')}}" type="text" class="form-control" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
           <input name="password"  type="password" id="password" class="form-control" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
                             <div class="fa-align shift_left" ><a href="{{url('/password/reset')}}">Forgot Password</a></div>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
           <button type="submit" name="cmdSubmit" value="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
         
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>



        </form> 

</body>
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
