@extends('jobzerda_admin.admin_template')

@section('editTitle',"Candidate List")

@section('content')
 <form method="GET" class="form-horizontal" id="frm_job_add" action="{{url('admin/filter_canditate')}}">
            {{ csrf_field() }}

                              <div class="row">
                <div class="col-lg-3">
                  <label>Select</label>
                  <select class="form-control" name="condition">
            <option value="7" @if($status=="7") {{ 'selected' }} @endif>All</option>
            <option value="0" @if($status=="0") {{ 'selected' }} @endif>Pending Candiate</option>
            <option value="1" @if($status=="1") {{ 'selected' }} @endif>Candiate not intrested</option>
            <option value="2" @if($status=="2") {{ 'selected' }} @endif>Candiate is intrested</option>
            <option value="3"  @if($status=="3") {{ 'selected' }} @endif>Employer rejects candidate </option>
            <option value="4" @if($status=="4") {{ 'selected' }} @endif>Employer is interested</option>
            <option value="5" @if($status=="5") {{ 'selected' }} @endif>Employer rejects candidate after interview</option>
            <option value="6" @if($status=="6") {{ 'selected' }} @endif>Candidate passes interview</option>
                  </select>
                  </div>
                   <div class="col-lg-3">
              <!-- Date range -->
              <div class="form-group">
                <label>From Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control from_date" id="from" name="from" placeholder="MM/DD/YYYY" type="text" value=@if($from!="") {{ $from }} @endif>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                </div>
                   <div class="col-lg-3">
              <!-- Date range -->
              <div class="form-group">
                <label>To Date:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control to_date" id="to" name="to" placeholder="MM/DD/YYYY" type="text" value=@if($to!="") {{ $to }} @endif>
               </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                </div>
                <div class="col-lg-3">
                    <label>Search</label>
                                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search" ></i>
                  </button>
              </span>
                  </div>
                </div>
</form>
<br><br>



      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Candidate List</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                </div>
              </div>
            </div>

            <?php  
//for the  serial numner
            $count = 1; ?>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Resume</th>
                  <th>Candidate Name</th>
                  <th>Employer Name</th>
                  <th>Job Details</th>
                  <th>Candidate Status</th>
                  <th>Employer Status</th>
                  <th>Date</th>
                </tr>
                @if (!@$errors->any())
                @foreach($users as $user)

                <tr>
                  <td>{{ (($users->currentPage() - 1 ) * $users->perPage() ) + $count}}</td>
                  <td> <a href="{{ asset('/upload_resume/'.$user->resume)}}" target="_blank">View Resume</a></td>
                  <td>{{$user->c_F}}&nbsp;{{$user->c_L}}</td>
                  <td>{{$user->e_F}}&nbsp;{{$user->e_L}}</td>
                   <td>{{$user->job_title}}</td>
                  @if($user->c_Status=='P' && $user->e_Status=='N')
                    <td>Pending</td>
                    <td>Null</td>
                  @elseif($user->c_Status=='A' && $user->e_Status=='P')
                    <td>Active</td>
                    <td>Pending</td>
                  @elseif($user->c_Status=='D' && $user->e_Status=='N')
                    <td>Processed</td>
                    <td>Null</td>
                  @elseif($user->c_Status=='A' && $user->e_Status=='A')
                    <td>Active</td>
                    <td>Active</td>
                  @elseif($user->c_Status=='S' && $user->e_Status=='S')
                    <td>Successfull</td>
                    <td>Successfull</td>
                  @elseif($user->c_Status=='D' && $user->e_Status=='R')
                    <td>Processed</td>
                    <td>Rejected</td>
                  @elseif($user->c_Status=='D' && $user->e_Status=='D')
                    <td>Processed</td>
                    <td>Processed</td>
                  @endif
                  <td>{{  date('m/d/Y', strtotime($user->s_Date)) }}</td>

                </tr>
                <?php $count++; ?>
              @endforeach
              @endif
              </table>
              {{ $users->appends(array('status'=>$status,'from' => $from,'to'=>$to))->links() }}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<script type="text/javascript">

    $(document).ready(function(){


var startDate = new Date('01/01/2012');
var FromEndDate = new Date();
var ToEndDate = new Date();

ToEndDate.setDate(ToEndDate.getDate()+365);

$('.from_date').datepicker({
    
    weekStart: 1,
    startDate: '01/01/2012',
    endDate: FromEndDate, 
    autoclose: true
})
    .on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.to_date').datepicker('setStartDate', startDate);
    }); 
$('.to_date')
    .datepicker({
        
        weekStart: 1,
        startDate: startDate,
        endDate: ToEndDate,
        autoclose: true
    })
    .on('changeDate', function(selected){
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('.from_date').datepicker('setEndDate', FromEndDate);
    });
});

</script>

@stop
