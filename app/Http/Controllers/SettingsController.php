<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\setting;
use App\Models\User;
use App\Models\business;
class SettingsController extends Controller
{
    public function settings(Request $request)
    {
       $setings = setting::first();
       return view('settings.settings')->with(['settings' =>$setings]);
    }
    public function updatesettings(Request $request)
    {
        if($request->businessname!=NULL){
            $settings =setting::find(1);
            $settings->companyname =$request->businessname;  
            if($request->logo!=NULL) {               
                $filename    = time().'.'.$request->logo->extension();  
                $request->logo->move(public_path('storage/uploads/'), $filename);                        
                $settings->logo =$filename;       
            }                  
            $settings->save();        
            }
            return redirect()->back()->with('success', 'Software information updated'); 
    }

    public function billingsetting(Request $request)
    {
       $setings = setting::first();
       return view('settings.billing')->with(['settings' =>$setings]);
    }

    public function billingsettingsave(Request $request)
    {
     
            $settings =setting::find(1);            
            $settings->prefix =$request->prefix;   
            $settings->suffix =$request->suffix;
            $settings->taxstatus =$request->taxstatus;   
            $settings->taxname =$request->taxname;
            $settings->taxpercent =$request->taxpercent;   
            $settings->invoicenote =$request->invoicenote;
            $settings->quotenote =$request->quotenote;           
            $settings->save();        
            return redirect()->back()->with('success', 'Billing information updated'); 
    }

    public function businesssetting(Request $request)
    {
       $business = business::find(1);
       return view('settings.business')->with(['business' =>$business]);
    }

    public function businesssettingsave(Request $request)
    {
     
            $settings =business::find(1);            
            $settings->businessname =$request->businessname;   
            $settings->email =$request->email;
            $settings->contactnum =$request->contactnum;   
            $settings->taxid =$request->taxid;
            $settings->address =$request->address;   
            $settings->address2 =$request->address2;
            $settings->city =$request->city;  
            $settings->state =$request->state;   
            $settings->country =$request->country;
            $imagefile = $request->logo;
            if($imagefile!=NULL) {               
                $filename    = time().'.'.$request->logo->extension();  
                $request->logo->move(public_path('storage/uploads/'), $filename);                        
                $settings->logo =$filename;       
            }        
            $settings->status =1;              
            $settings->save();        
            return redirect()->back()->with('success', 'Business information updated');  
    }

    
    
}
