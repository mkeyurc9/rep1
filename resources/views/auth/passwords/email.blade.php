<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Rejoice</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{url("/css/custom.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("/plugins/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("/plugins/simple-line-icons/simple-line-icons.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("/plugins/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{url("/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("/plugins/select2/css/select2-bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{url("/css/components.min.css")}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{url("/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{url("pages/css/login.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->

        <link rel="shortcut icon" href="favicon.ico" /> 

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{url("/layouts/layout2/css/layout.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("/layouts/layout2/css/themes/blue.min.css")}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{url("/layouts/layout2/css/custom.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <script src="{{url("/plugins/jquery.min.js")}}" type="text/javascript"></script>
        <style>
            .error{color:#C00 !important;}
            .help-block-error{color:#C00 !important;}
            .success{color:#009c0b;}
        </style>
    </head>
    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="/login">
                <img src="" alt="" />Rejoice</a>
        </div>
        <div class="content">
            <form id="admin_login" class="login-form" accept-charset="utf-8" method="post" action="{{ url('/password/email') }}" >
                {{ csrf_field() }}
                <h3 class="form-title font-green">Reset Password</h3>
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">E-Mail Address</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" value="{{ old('email') }}" placeholder="E-mail" name="email" /> 
                </div>
                <div class="form-actions">
                    <button type="submit" value="LSubmit" name="LSubmit" class="btn green uppercase">Send Password Reset Link</button>
                    <a href="{{url('/login')}}" class="btn green btn-outline">Cancel</a>
                </div>
            </form>
        </div>
        <div class="copyright"> <?php echo date('Y'); ?> ©Rejoice. Admin Dashboard Template. </div>
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{url("/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
        <script src="{{url("/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
        <script src="{{url("/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
        <script src="{{url("/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
        <script src="{{url("/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{url("/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
        <script src="{{url("/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
        <script src="{{url("/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{url("/scripts/app.min.js")}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
    </body>
</html>