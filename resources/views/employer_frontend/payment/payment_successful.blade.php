@include('layouts.app')
<div class="container">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light ">
@if(Session::has('error'))
<div class="custom-alerts alert alert-danger fade in">
{{Session::get('error')}}
</div>
@endif
@if(Session::has('success'))
 <div class="custom-alerts alert alert-success fade in">
{{Session::get('success')}}
</div>
@endif


    </div>
</div>