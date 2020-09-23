<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Handlers\ImageUploadHandler;
class UsersController extends Controller
{
    public function create(){

    	return view('users.create');
    }

    public function show(User $user){
    	return view('users.show',compact('user'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'name'     =>'required|max:50',
    		'email'    =>'required|email|unique:users|max:200',
    		'password' =>'required|confirmed|min:6',
    	]);
    	$user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password),
    	]);
        Auth::login($user);
        session()->flash('success', '注册成功！');
    	return redirect()->route('users.show', [$user]);
    }

    public function edit(User $user){
        return view('users.edit', compact('user'));
    }
    public function update(User $user, Request $request, ImageUploadHandler $uploader){

       $this->validate($request,[
            'name'     =>'required|max:50',
            'password' =>'nullable|confirmed|min:6',
        ]);
       $data = [];
       $data['name'] = $request->name;
       if($request->password){
            $data['password'] = bcrypt($request->password);
       }

       if($request->avatar){
          $result = $uploader->save($request->avatar, 'avatar', $user->id);
          if($result){
            $data['avatar'] = $result['path'];
          }
       }
       $user->update($data);
       session()->flash('success', '更新成功！');
       return redirect()->route('users.show', [$user]);
    }
}
