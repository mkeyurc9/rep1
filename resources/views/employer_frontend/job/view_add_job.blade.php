@include('layouts.app')
<div class="container">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light ">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Job Location</th>
                    <th>Job Created Date</th>
                    <th>Pending for review</th>
                    <th>Active in Interview Phase</th>
                    <th>Candidates not considered</th>
                    <th>Candidates Rejected</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tbody_filter">
                @foreach($jobs as $job)
                <tr>
                    <td>{{$job['title']}}</td>
                    <td>{{$job['location']}}</td>
                    <td>{{$job['created_at']}}</td>
                    <td>{{$job['cnt_pending_review']}}</td>
                    <td>{{$job['active_in_interview_phase']}}</td>
                    <td>{{$job['candidates_not_considered']}}</td>
                    <td>{{$job['candidates_rejected']}}</td>
                    
                    <td>
                     @if($job['cnt_pending_review']< 1 && $job['active_in_interview_phase']< 1 && $job['candidates_not_considered']< 1 && $job['candidates_rejected']<1) 
                        <a href="{{url('edit_job/'.$job['id'])}}">Edit</a>
                     @endif
                       <a href="{{url('view_employer_job/'.$job['id'])}}">view</a> 
                    </td>
                </tr>
                @endforeach
            </tbody>             
        </table>
        {{$jobs->links()}}
    </div>
</div>