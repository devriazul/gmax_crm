<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('id','desc')->paginate(15);
        return view('admin.listofadmin')->with(['users' =>$users]);
    }

    public function createnewadmin(Request $request)
    {
        if($request->name!=NULL){
        $user =new User();
        $user->name =$request->name;
        $user->email  =$request->email;
        $user->password =Hash::make($request['password']);
        $user->usertype = $request->usertype;
        $user->save();        
        }
        return redirect('/admin/listofusers');
    }

    public function updateadmin(Request $request)
    {
        if($request->name!=NULL){
            $user =User::find($request->id);
            $user->name =$request->name;
            $user->email  =$request->email;
                if($request->password!=NULL){
                    $user->password =Hash::make($request['password']); 
                }
            $user->usertype = $request->usertype;
            $user->save();        
            }
            return redirect('/admin/listofusers');
    }

    public function deleteadmin(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect('/admin/listofusers');
    }
    
}
