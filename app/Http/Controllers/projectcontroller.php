<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\client;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\project;
use App\Models\projecttask;
use App\Models\projectnote;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class projectcontroller extends Controller
{
    
    public function listofprojects(Request $request)
    { 
        $client = client::all();
        $projects = QueryBuilder::for(project::class)
        ->allowedFilters(['projectname','client','status'])
        ->orderBy('id','desc')->paginate(15);       
        return view('app.listofprojects')->with(['projects' =>$projects])->with(['clients'=> $client]);     
    }

    public function createnewproject(Request $request)
    {   
        $project =new project();
        $project->projectname=$request->projectname;
        $project->client =$request->client;
        $project->description =$request->description;
        $project->startdate =$request->startdate;
        $project->deadline =$request->deadline;
        $project->status =1;
        $project->save();        
        $lastid = $project->id;
        $project =new projectnote();
        $project->pjid=$lastid;
        $project->admin = Auth::id();  
        $project->note ='Add Something';
        $project->save();

        return redirect('/projects')->with('success', 'Project Created');  
    }

    public function deleteproject(Request $request)
    {
     $project = project::findOrFail($request->id);      
     $project->delete();
     return redirect('/projects')->with('success', 'Project Deleted');  
    }

    public function viewproject(Request $request)
    {         
        $client = client::all();
        $project = project::findOrFail($request->id);  
        $startdate = Carbon::parse($project->startdate);
        $deadline = Carbon::parse($project->deadline);
        $totaldays =   $startdate->diffInDays($deadline);           
        $today = Carbon::now();
        $balancedays = $today->diffInDays($deadline);  
         if($totaldays==0){ $totaldays=1; }
        $percentage = $balancedays * 100 / $totaldays;
        

        return view('app.projectview')->with(['project' =>$project])->with(['prid' =>$request->id])->with(['percentage' =>$percentage])->with(['balancedays' =>$balancedays]); 
    }

    public function viewtasks(Request $request)
    { 
        $client = client::all();
        $task = Projecttask::where('prid',$request->id)->paginate(30);                
        return view('app.projectviewtasks')->with(['tasks' =>$task])->with(['prid' =>$request->id]);     
    }

    public function viewnote(Request $request)
    { 
        $client = client::all();
        $note = projectnote::where('pjid',$request->id)->first();            
        return view('app.projectviewnote')->with(['note' =>$note])->with(['prid' =>$request->id]);      
    }
    

    public function createprjcttask(Request $request)
    {   
        $project =new projecttask();
        $project->prid=$request->prid;
        $project->aid = Auth::id();  
        $project->task =$request->task;
        $project->assignedto ='';
        $project->type =$request->type;
        $project->status =1;
        $project->save();    
        return redirect()->back()->with('success', 'Task Created');
    }

    public function updatenote(Request $request)
    {   
        $project = projectnote::findOrFail($request->id);       
        $project->admin = Auth::id();  
        $project->note =$request->note;
        $project->save();     
        return redirect()->back()->with('success', 'Note Updated');
    }

    public function projecttaskupdate(Request $request)
    {   
        $project = projecttask::findOrFail($request->id);     
        $project->status =$request->status;
        $project->save();     
        return redirect()->back()->with('success', 'Task Updated');
    }

    public function deletetasks(Request $request)
    {
     $project = projecttask::findOrFail($request->id);      
     $project->delete();
     return redirect()->back()->with('success', 'Task Deleted');
    }

    
    public function updateproject(Request $request)
    {   
        $project = project::findOrFail($request->id);     
        $project->projectname =$request->projectname;      
        $project->startdate =$request->startdate;
        $project->deadline =$request->deadline;     
        $project->save();     
        return redirect()->back()->with('success', 'Project Updated');
    }

    public function updateprojectdescript(Request $request)
    {   
        $project = project::findOrFail($request->id);         
        $project->description =$request->description;   
        $project->save();     
        return redirect()->back()->with('success', 'Project Updated');
    }

    
    public function projectstatuschange(Request $request)
    {   
        $project = project::findOrFail($request->id);       
        $project->status =$request->status;     
        $project->save();     
        return redirect()->back()->with('success', 'Status Updated');
    }

}
