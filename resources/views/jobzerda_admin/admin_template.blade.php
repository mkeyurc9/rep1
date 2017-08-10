<!DOCTYPE html>
<html>
@include('jobzerda_admin.layouts.header')
<header class="main-header">
    <a href="{{url('admin')}}" class="logo"><b>Admin</b>JobZedra</a>
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-custom-menu">
           <a href="{{ url('user_logout') }}" class="btn btn-primary">Sign Out</a> 
        </div>  
    </nav>
</header>
<body class="skin-blue">
<div class="wrapper">
    @include('jobzerda_admin.layouts.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
             {{ $page_title or "JobZedra Admin" }}
                 @yield('editTitle')
                <small>{{ $page_description or null }}</small>
            </h1>
        </section>
        <section class="content">
            @yield('content')
        </section>
    </div>
    @include('jobzerda_admin.layouts.footer')
</div>
</body>
</html>
