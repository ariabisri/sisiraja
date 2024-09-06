<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{    
    public function index()
    {
        $data = User::get();

        return view('user.index' ,compact('data'));
    }
    public function create(){
        return view('user.create');
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required|in:admin,peneliti',
        ]);
    
        if($validator->fails()) 
            return redirect()->back()->withInput()->withErrors($validator);

        $emailExists = User::where('email', $request->email)->exists();
        if ($emailExists) {
            Session::flash('error', 'Email sudah terdaftar.');
            return back();
        }
        
        
    
        $data['email'] = $request->email;
        $data['username'] = $request->username;
        $data['password'] = Hash::make($request->password);
        $data['role'] = $request->role;
        $data['active'] = $request->has('active') ? $request->active : 1;
        $data['created_at'] = now();
        $data['updated_at'] = now();
        
        try {
            User::create($data);
            return redirect()->route('user.index')->with('success', 'User berhasil dibuat.');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function edit(Request $request,$id){
        $data = User::find($id);

        return view('user.edit' ,compact('data'));
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'nullable',
            'role' => 'nullable|in:admin,peneliti',
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
        
        return redirect()->route('user.index');   
    }

    public function delete(Request $request, $id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('user.index');
    }

}