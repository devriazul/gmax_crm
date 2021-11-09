<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\client;
use App\Models\invoice;
use App\Models\project;

use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function addclient(Request $request)
    {        
        return view('app.addclient');
    }

    public function addclientsave(Request $request)
    {       
        $client =new client();
        $client->name =$request->name;
        $client->business =$request->business;
        $client->email =$request->email;
        $client->phone =$request->phone;
        $client->address =$request->address;
        $client->address2 =$request->address2;
        $client->city =$request->city;
        $client->state =$request->state;
        $client->country =$request->country;
        $client->zip =$request->zip;  
        $client->taxid =$request->taxid;  
       // $client->group =$request->group;    
        $client->addedby = Auth::id();        
        $client->save();        
        $lastid = $client->id;
      
       // Mail::to($request->email)->send(new welcomemail($client));
     
       return redirect()->route('viewclient', ['id'=>$lastid])->with('success', 'New Client Added');
    }

    public function editclient(Request $request)
    {   
        $client = client::findOrFail($request->id);
        return view('app.editclient')->with(['client' =>$client]);     
    }

    public function editclientsave(Request $request)
    {       
        $client = client::findOrFail($request->id);
        $client->name =$request->name;
        $client->business =$request->business;
        $client->email =$request->email;
        $client->phone =$request->phone;
        $client->address =$request->address;
        $client->address2 =$request->address2;
        $client->city =$request->city;
        $client->state =$request->state;
        if($request->country!=NULL){ $client->country =$request->country; }
        $client->zip =$request->zip;  
        $client->taxid =$request->taxid;         
        $client->save();        
        $lastid = $request->id; 
       return redirect()->route('viewclient', ['id'=>$lastid])->with('success', 'Client Profile Updated');
    }

    public function listofclients(Request $request)
    { 
        $clients = client::orderby('id','desc')->paginate(15);     
        return view('app.listofclients')->with(['clients' =>$clients]);     
    }

    public function deleteclient(Request $request)
    { 
       $client = client::findOrFail( $request->id);
       $deleteinvoices = invoice::where('userid',$request->id)->delete();
       $deleteprojects = project::where('client',$request->id)->delete();        
       $client->delete();
       return redirect('/clients')->with('success', 'Client Profile Deleted'); 
    }

    public function viewclient(Request $request)
    {   
      
        $projects = project::where('client',$request->id)->orderBy('id','desc')->paginate(15);       
        $client = client::findOrFail($request->id);
        $invoices = invoice::where('userid',$request->id)->where('type',2)->orderby('id','desc')->paginate(10); 
        $quotes = invoice::where('userid',$request->id)->where('type',1)->orderby('id','desc')->paginate(10);        
        return view('app.viewclient')->with(['client' =>$client])->with(['invoices' =>$invoices])->with(['quotes' =>$quotes])->with(['projects' =>$projects]);    
    }

}
