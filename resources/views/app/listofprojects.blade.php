@extends('layouts.app')

@section('title', 'Page Title')

@section('content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title">Project Manager</h3>
      <div style="float: right; right:0; margin-right:10px; position: absolute;">
       
      <button type="button"  onclick="advancedsearch()"
      class="btn btn-primary btn-sm">Advanced Search</button>
      <button type="button" data-toggle="modal" data-target="#modal-simple"      
      class="btn btn-success btn-sm">Create New Project</button>
      </div> 
    </div>
      <div id="advancedsearch" style="display:none;">
        <form action="{{ route('listofprojects') }}" method="get">
          <div class="row" style=" margin:10px;">				
            <div class="col-md-2">					
                <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Title</label>
                <input type="text" class="form-control form-control-sm" name="filter[projectname]" placeholder="Invoice Title">					 
            </div>
            
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Client</label>
              <select class="form-select  form-select-sm" name="filter[client]">
                <option value="">Select Client</option>
                @foreach($clients as $client)
                <option value="{{$client->id}}">{{$client->name}}</option>
                @endforeach
                </select>					 
            </div>
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Status</label>
              <select class="form-select  form-select-sm" name="filter[status]">
                <option value="">Select Status</option>
                <option value="1">Not Started</option>
                <option value="2">In Progress</option>
                <option value="3">In Review</option>
                <option value="4">On Hold</option>
                <option value="5">Completed</option>  
                <option value="6">Cancelled</option>          
                </select>					 
            </div>
           
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">&nbsp;</label>
              <button type="submit" class="btn btn-warning  btn-sm"> Search </button>
            </div>
          </div>
        </form>
        </div>
   

    <div class="table-responsive" id="theTable">
      <table class="table card-table table-vcenter text-nowrap datatable" >
        <thead>
            <tr>
                <th>ID </th>
                <th>Title </th>
                <th>Client </th>
                <th>Start Date </th>
                <th>Deadline </th>           
                <th>Staus</th>
                
                <th></th>
            </tr>
        </thead>
        <tbody>
          
            @foreach($projects as $project)
            <tr>
               
                <td>
                  
                   # {{$project->id}}
                </td>
                <td><a href="{{route('viewproject', ['id' => $project->id])}}"> {{$project->projectname}}</a></td>
                <td>
                  <a href="/client/ {{ !empty($project->clientdata) ? $project->clientdata->id:'' }}">   {{ !empty($project->clientdata) ? $project->clientdata->name:'Removed' }} </a>
                 
                </td>
                <td>
                    {{$project->startdate}}
                </td>
                <td> {{$project->deadline}}
                </td>  
              
                <td>
                    @if($project->status ==1)<span class="badge btn-white">Not Started</span>@endif
                            @if($project->status ==2)<span class="badge bg-blue">In Progress</span>@endif
                            @if($project->status ==3)<span class="badge bg-purple">In Review</span>@endif
                            @if($project->status ==4)<span class="badge bg-yellow">On Hold</span>@endif
                            @if($project->status ==5)<span class="badge bg-green">Completed</span>@endif
                            @if($project->status ==6)<span class="badge bg-dark">Cancelled</span>@endif   
                       
                </td>
               
                <td class="text-right">
                   
                        <a href="/project/{{$project->status}}" class="btn btn-white btn-sm "
                          >View Project</a>
                       
                  
                </td>
            </tr>
           @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      <p class="m-0 text-muted">Showing  {{$projects->count()}} entries</p>
      <ul class="pagination m-0 ms-auto">
        {{$projects->links()}}
      </ul>
    </div>
  </div>


  
  <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create New Project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    <form action="{{route('createnewproject')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="mb-2">
                <label class="form-label">Project Title</label>
                <input type="text" class="form-control" name="projectname" placeholder="Project Title Here">
            </div>
            <div class="mb-2">
                <label class="form-label">Select Client <a href="{{route('addclient')}}" style="float:right;"> Add New Client </a></label>
                <select name="client" id="select-users" class="form-select">
                   @foreach($clients as $client)
                    <option value="{{$client->id}}">{{$client->name}}</option>
                   @endforeach
                  </select>
            </div>
            <div class="mb-2">
                <label class="form-label">Start Date</label>
                <input type="date" value="@php echo date('Y-m-d'); @endphp" class="form-control" name="startdate" placeholder="Start Date">
            </div>
            <div class="mb-2">
                <label class="form-label">DeadLine</label>
                <input type="date" value="@php echo date('Y-m-d'); @endphp" class="form-control" name="deadline" placeholder="DeadLine">
            </div>
            
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" >Create Project</button>
        </div>
        </form>
      </div>
    </div>
  </div>
    
	  <script>
      function advancedsearch() {
        var x = document.getElementById("advancedsearch");
        if (x.style.display === "none") {
        x.style.display = "block";
        } else {
        x.style.display = "none";
        }
      }



      </script>

@endsection
