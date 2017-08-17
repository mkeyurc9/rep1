@extends('jobzerda_admin.admin_template')

@section('editTitle',"Candidate Profiles")

@section('content')
<form method="GET" class="form-horizontal" id="frm_job_add" action="{{url('admin/filter_status_canditate')}}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-3">
                  <label>Profile Status</label>
                  <select class="form-control" name="condition">
                      <option value="0"  @if($status=="0") {{ 'selected' }} @endif>All</option>
                      <option value="1"  @if($status=="1") {{ 'selected' }} @endif>Active</option>
                      <option value="2"  @if($status=="2") {{ 'selected' }} @endif>Inactive</option>
                  </select>
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
              <h3 class="box-title">Candidate Profiles</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                </div>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Profile Status</th>
                  <th>PM Exper</th>
                  <th>Resume</th>
                  <th>Updated At</th>
                </tr>
                @if (!@$errors->any())
                @foreach($users as $user)

                <tr>
                  <td>{{$loop->index+1}}</td>
                  <td>{{$user->c_F}}&nbsp;{{$user->c_L}}</td>
                   <td>{{$user->email}}</td>
                   <td>{{$user->phone}}</td>
                   <td>@if($user->PS=='A'){{ 'Active' }} @else {{ 'Inactive' }} @endif</td>
                   <td>{{$user->exper}}</td>
                  <td> <a href="{{ asset('/upload_resume/'.$user->resume)}}" target="_blank">View Resume</a></td>
                  <td>{{ date('m/d/Y', strtotime($user->updated_at)) }}</td>

                </tr>
              @endforeach
              @endif
              </table>
              {{ $users->appends(array('status'=>$status))->links() }}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
@stop