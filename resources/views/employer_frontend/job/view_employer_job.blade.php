@include('layouts.app')
<div class="container">
    <div class="row">
        <div class="portlet-body">
            <form method="post" class="form-horizontal" id="frm_job_add" action="">
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
                        <label class="control-label col-md-3">Job Title
                        </label>
                        <div class="col-md-4">
                            {{$job['title']}}
                        </div>
                        <label class="control-label col-md-3">Candidates Pending for review
                            @if(!empty($pending->toArray()))
                            @foreach($pending as $pnd)
                                @foreach($pnd['candidate_signup'] as $c_d)
                                 <br>
                                  <a href="{{url('employer_candidate_profile/'.$pnd['id'])}}">{{$c_d['firstname']." ".$c_d['lastname']}}</a>
                                  
                                @endforeach
                            @endforeach
                             @else
                            <br>
                             No Data Found
                            @endif
                        </label>
                        <div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Job Location
                        </label>
                        <div class="col-md-4">
                            {{$job['location']}}
                        </div>
                        <label class="control-label col-md-3">Candidates Active in Interview Phase
                        </label>
                        <div>
                            @if(!empty($active->toArray()))
                            @foreach($active as $pnd)
                                @foreach($pnd['candidate_signup'] as $c_d)
                                 <br>
                                  <a href="{{url('employer_candidate_profile/'.$pnd['id'])}}">{{$c_d['firstname']." ".$c_d['lastname']}}</a>
                                @endforeach
                            @endforeach
                             @else
                            <br>
                             No Data Found
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Job Type
                        </label>
                        <div class="col-md-4">
                            @foreach($domains as $domain)
                            {{$domain->name}}
                            @if (!$loop->last)
                            {{ '&nbsp;&nbsp;|&nbsp;&nbsp;' }}
                            @endif
                            @endforeach
                        </div>
                        <label class="control-label col-md-3">Candidates Processing
                        </label>
                        <div>
                            <div>
                            @if(!empty($process->toArray()))
                            @foreach($process as $pnd)
                                @foreach($pnd['candidate_signup'] as $c_d)
                                 <br>
                                  <a href="{{url('employer_candidate_profile/'.$pnd['id'])}}">{{$c_d['firstname']." ".$c_d['lastname']}}</a>
                                @endforeach
                            @endforeach
                            @else
                            <br>
                             No Data Found
                            @endif
                           </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Job level
                        </label>
                        <div class="radio">
                            {{$job['level']}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Annual Salary range in USD</label>
                        <div class="col-md-4">
                            {{$job['annual_salary']}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Preferred Domain experience
                        </label>
                        <div class="checbox col-md-8">
                            <div class="col-md-4">
                            @foreach($pm_experiences as $domain)
                            {{$domain->name}}
                            @if (!$loop->last)
                            {{ '&nbsp;&nbsp;|&nbsp;&nbsp;' }}
                            @endif
                            @endforeach
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Job Description
                        </label>
                        <div class="col-md-4">
                            {{$job->description}}
                        </div>
                        <label class="control-label col-md-3">Candidates not considered
                    </label>
                    <div>
                            <div>
                            @if(!empty($rejected->toArray()))
                            @foreach($rejected as $pnd)
                                @foreach($pnd['candidate_signup'] as $c_d)
                                 <br>
                                  <a href="{{url('employer_candidate_profile/'.$pnd['id'])}}">{{$c_d['firstname']." ".$c_d['lastname']}}</a>
                                @endforeach
                            @endforeach
                            @else
                            <br>
                             No Data Found
                            @endif
                           </div>
                        </div>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</div>
<script>
</script>