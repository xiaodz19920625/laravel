<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class FollowersController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }
    public function store(User $user){
    	$this->authorize('follow', $user);
    	if(!Auth::user()->isFollowing($user->id)){
    		//没有关注过，则取消关注
    		Auth::user()->follow($user->id);
    	}
    	return redirect()->route('users.show',$user->id);
    }
    public function destroy(User $user){
    	//自己不能取消关注自己，先做授权判断
    	$this->authorize('follow', $user);
    	if(Auth::user()->isFollowing($user->id)){
    		//关注过，则取消关注
    		Auth::user()->unfollow($user->id);
    	}
    	return redirect()->route('users.show',$user->id);
    }
}
