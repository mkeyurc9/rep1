@include('layouts.app')
<div class="container">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light ">
        @if(Session::has('message'))
        <div class="alert alert-success delete_msg">
            {{ Session::get('message') }}
        </div>
        @endif         
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Interview Status</label>
                    <select class="form-control" name="candidate_status" id="candidate_status" onchange="get_jobs()">
                        <option value="PA">Pending And Active</option>
                        <option value="P">Pending</option>
                        <option value="A">Active</option>
                        <option value="D">Processed</option>
                    </select>              
                </div>
            </div>
        </div>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="tbody_filter">
                @if($matching_algo->toArray()['total']==0)
                    <tr><td>No Matching Jobs Available</td></tr>
                @else
                @foreach($matching_algo as $mat_algo)
                <tr>
                    <td><a href="{{url("display_job_description/".$mat_algo['job_id'])}}">{{$mat_algo['employer_signup']->company_name}}</a></td>
                    @if($mat_algo['candidate_status']=='P')<td> Pending</td>@elseif($mat_algo['candidate_status']=='N')<td> Null</td> @elseif($mat_algo['candidate_status']=='A') <td>Active</td> @else <td>Processed</td> @endif
                </tr>
                @endforeach
                @endif
            </tbody>            
        </table>
        {{ $matching_algo->links() }}
    </div>
</div>
<script>
    function get_jobs() {
        var url = "{{URL::to('view_matched_jobs')}}";
        var cur = $('#candidate_status').val();
        $.ajax({
            url: url,
            data:{cur:cur,"_token": "{{csrf_token()}}"},
            cache:false,
            type:'GET',
            success:function(data){ // this is view data returned by controller
                console.log(data);
            $('#tbody_filter').html(data); // use it to fill your results
            }
        });
    }
</script>    