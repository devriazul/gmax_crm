@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<div class="row">
    <div class="col-md-3">
      @include('app.projectnav')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Add Project Tasks</h4>
    </div>
    <div class="card-body">
        <form action="{{route('createprjcttask')}}" method="post">
            @csrf
            <input type="hidden" name="prid" value="{{$prid}}">
            <div class="row">
                <input type="hidden" value="146" name="leadid">
                <div class="mb-2 ">
                    <label class="form-label">Task</label>
                    <input type="text" class="form-control" name="task" placeholder="Enter Task">
                </div>                
                <div class="mb-3">
                    <label class="form-label">Priority</label>
                    <select class="form-select" name="type">
                        <option value="bg-azure">Low</option>
                        <option value="bg-green">Normal</option>
                        <option value="bg-orange">High</option>
                        <option value="bg-red">Urgent</option>
                    </select>
                </div>
                
              
            </div>
            <button type="submit" class="btn btn-success btn-block">Add Task</button>
        </form>
    </div>
</div>

    </div>
    <div class="col-md-9">
       
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Project Tasks</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table card-table table-vcenter">
            <tbody>
             @foreach($tasks as $task)    
            <tr>

                <td class="w-1 pr-0">
                <form action="{{route('projecttaskupdate')}}" method="post">
                        @csrf
                        @if($task->status==0)
                            <input type="hidden" value="1" name="status">
                        @else 
                            <input type="hidden" value="0" name="status">
                        @endif
                        <input type="hidden" value="{{$task->id}}" name="id">
                        <label class="form-check m-0">
                            <input type="checkbox" class="form-check-input"  onChange="this.form.submit()" @if($task->status==0) checked @endif>
                            <span class="form-check-label"></span>
                        </label>
                    </form>
                </td>
                <td class="w-100">
                <a href="#" class="text-reset">{{$task->task}}</a>
                </td>
                     <td>
                    <span class="avatar  rounded-circle" data-toggle="tooltip" data-placement="bottom" title="{{$task->admindata->name}} " style="background-image: url({{$task->admindata->profile_photo_url}})"></span>
                  </td>
               
                <td class="text-nowrap" style="padding-top: 2px;">                          
                   
                    <div class="spinner-grow {{$task->type}}" style="height: 12px; width:12px; padding-top: -15px" role="status"></div>
                                     </td>
                <td class="text-nowrap">
                <a href="/project/tasks/delete/{{$task->id}}" onclick="return confirm('Are you sure?')" class="text-muted">
                   
	      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    </a>
                </td>
              
            </tr>
            @endforeach
            
            </tbody>
          </table>
            {{ $tasks->links() }}
        </div>
        </div>
      </div>
    </div>

  
    
</div> 




@endsection
