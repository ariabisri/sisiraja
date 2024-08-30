<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{    
    public function dashboard(){
        return view('dashboard');
    }
    public function index()
    {
        $data = User::get();

        return view('index' ,compact('data'));
    }
    public function create(){
        return view('create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
    
        if($validator->fails()) 
            return redirect()->back()->withInput()->withErrors($validator);
        
    
        $data['email'] = $request->email;
        $data['username'] = $request->username;
        $data['password'] = Hash::make($request->password);
        $data['role'] = $request->role;
        $data['active'] = $request->has('active') ? $request->active : 1;
    
        User::create($data);
    
        return redirect()->route('index');
    }

    public function edit(Request $request,$id){
        $data = User::find($id);

        return view('edit' ,compact('data'));
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'nullable',
            'role' => 'nullable',
        ]);
    
        if($validator->fails()) 
            return redirect()->back()->withInput()->withErrors($validator);
        
    
        $data['email'] = $request->email;
        $data['username'] = $request->username;
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        $data['role'] = $request->role;
        $data['active'] = $request->has('active') ? $request->active : 1;
    
        

    
        User::where('id', $id)->update($data);
        
        return redirect()->route('index');   
    }

    public function delete(Request $request, $id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('index');
    }

}