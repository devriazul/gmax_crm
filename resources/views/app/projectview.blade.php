@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<div class="row">
    <div class="col-md-3">
     
      @include('app.projectnav')
      
        <div class="dropdown-menu dropdown-menu-demo">
            <span class="dropdown-header">Project</span>
           
            <a class="dropdown-item " href="#timeline"  data-toggle="modal" data-target="#editproject">            
           
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" style="margin-right: 10px;" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                 Edit Project
            </a>

            <a class="dropdown-item " href="/project/delete/{{$prid}}" onclick="return confirm('Are you sure?')" >                  
            
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" style="margin-right: 10px;" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                   Delete Project
              </a>
          

        </div>
<div class="dropdown-menu dropdown-menu-demo">
    <span class="dropdown-header">Update Project Status
    </span>
    <div class="m-3">
        <form action="{{route('projectstatuschange')}}" method="post">
            @csrf
            <select name="status" id="status" class="form-select">
               
              <option value="1" @if($project->status ==1) selected @endif>Not Started</option>
              <option value="2"  @if($project->status ==2) selected @endif>In Progress</option>
              <option value="3"  @if($project->status ==3) selected @endif>In Review</option>
              <option value="4"  @if($project->status ==4) selected @endif>On Hold</option>
              <option value="5"  @if($project->status ==5) selected @endif>Completed</option>  
              <option value="6"  @if($project->status ==6) selected @endif>Cancelled</option>  
            </select>
            <input type="hidden" value="{{$project->id}}" name="id">
        </form>
    </div>
</div>
        
<script type="text/javascript">
  jQuery(function() {
        jQuery('#status').change(function() {
            this.form.submit();
        });
    });
</script>
     

    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-8">
            <div class="card">
                  
                <div class="card-body">
                
                  <dl class="row">
                    <dt class="col-5">Project Name:</dt>
                    <dd class="col-7"> <strong>{{$project->projectname}} </strong></dd>
                    <dt class="col-5">Client:</dt>
                    <dd class="col-7"><a href="/client/{{$project->clientdata->id}}">{{$project->clientdata->name}}</a></dd>
                    <dt class="col-5">Start Date:</dt>
                    <dd class="col-7"><strong>{{$project->startdate}}</strong></dd>
                    
                    <dt class="col-5">Deadline:</dt>
                    <dd class="col-7"><strong>{{$project->deadline}}</strong></dd>
                    <dt class="col-5">Status:</dt>
                    <dd class="col-7">
                      @if($project->status ==1)<span class="badge btn-white">Not Started</span>@endif
                      @if($project->status ==2)<span class="badge bg-blue">In Progress</span>@endif
                      @if($project->status ==3)<span class="badge bg-purple">In Review</span>@endif
                      @if($project->status ==4)<span class="badge bg-yellow">On Hold</span>@endif
                      @if($project->status ==5)<span class="badge bg-green">Completed</span>@endif
                      @if($project->status ==6)<span class="badge bg-dark">Cancelled</span>@endif                                                                                                                         
                    </dd>
                    
                    <dt class="col-5"></dt>
                    <dd class="col-7"><strong></strong></dd>
                        
                     </dl>
                </div>
              
                </div>
            </div>
            @php $today = date("Y-m-d");   @endphp

            
            <div class="col-md-4">           
                <div class="card">
                    <div class="card-body p-4 py-3 text-center">
                      <span class="avatar avatar-xl mb-2 avatar-rounded @if($today>$project->deadline) bg-red-lt  @else bg-green-lt  @endif">{{$balancedays}}</span>
                      @if($today>$project->deadline)
                      <h3 class="mb-0">Days Overdue</h3>
                      @else
                      <h3 class="mb-0">Days Left</h3>
                      @endif

                     
                     
                      <div>
                        
                      </div>
                    </div>
                    <div class="progress card-progress">
                      <div class="progress-bar @if($today>$project->deadline) bg-red  @else bg-green  @endif" style="width: {{$percentage}}%" role="progressbar" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">
                        <span class="visually-hidden">{{$percentage}}% Complete</span>
                      </div>
                    </div>
                  </div>

             </div>

             <div class="col-md-12 mt-3">           
                <div class="card">
                    <div class="card-body p-2">
                      <form action="{{route('updateprojectdescript')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$project->id}}">
                        <textarea id="editor" class="form-control" style="width: 100%;"  name="description" rows="6">
                          {!!$project->description!!}
                        </textarea>
                  
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                          
                          <button type="submit"  class="btn btn-primary ms-auto">Save</a>
                        </div>
                      </div>
                    </form>
                </div>
             </div>      
             


        </div>
        
    </div>
    
</div> 


  
<div class="modal modal-blur fade" id="editproject" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
  <form action="{{route('updateproject')}}" method="post">
      @csrf
      <input type="hidden" name="id" value="{{$project->id}}">
      <div class="modal-body">
          <div class="mb-2">
              <label class="form-label">Project Title</label>
              <input type="text" class="form-control" name="projectname" value="{{$project->projectname}}" placeholder="Project Title Here">
          </div>
          
          <div class="mb-2">
              <label class="form-label">Start Date</label>
              <input type="date" value="{{$project->startdate}}" class="form-control" name="startdate" placeholder="Start Date">
          </div>
          <div class="mb-2">
              <label class="form-label">DeadLine</label>
              <input type="date" value="{{$project->deadline}}" class="form-control" name="deadline" placeholder="DeadLine">
          </div>
          
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" >Update Project</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )       
        .catch( error => {
            console.error( error );
            
        } 
        
        );
</script>

@endsection
