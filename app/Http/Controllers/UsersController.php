<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Handlers\ImageUploadHandler;
use Mail;
class UsersController extends Controller
{
    public function __construct(){
      $this->middleware('auth', [
        'except' => ['show','create', 'store', 'index','confirmEmail']
      ]);
      $this->middleware('guest', [
        'only' => ['create']
      ]);
    }
    //用户列表
    public function index(){
      $users = User::paginate(10);
      return view('users.index', compact('users'));
    }

    public function create(){

    	return view('users.create');
    }

    public function show(User $user){
      $statuses = $user->statuses()->orderBy('created_at','desc')->paginate(5);
    	return view('users.show',compact('user','statuses'));
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
        'activation_token' => str_random(30),
    	]);
      //发送激活邮件
      $this->sendEmailConfirmation($user);
      // Auth::login($user);
      session()->flash('success', '已发送验证邮件，请注意查收激活！');
    	return redirect()->route('users.show', [$user]);
    }

    protected function sendEmailConfirmation($user){
      $view = 'emails.confirm';
      $data = compact('user');
      $to = $user->email;
      $subject = '感谢您注册美莱微博，请尽快激活！';
      Mail::send($view, $data,function($message) use ($to, $subject){
        $message->to($to)->subject($subject);
      });
    }
    public function confirmEmail($token){
      $user = User::where('activation_token',$token)->firstOrFail();
      $user->activation_token = null;
      $user->activated = true;
      $user->save();
      Auth::login($user);
      session()->flash('success', '激活成功！');
      return redirect()->route('users.show', [$user]);
    }

    public function edit(User $user){
      //验证用户授权策略
      $this->authorize('update', $user);
      return view('users.edit', compact('user'));
    }
    public function update(User $user, Request $request, ImageUploadHandler $uploader){

      //验证用户授权策略
      $this->authorize('update', $user);
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

    public function destroy(User $user){
      $this->authorize('destroy', $user);
      $user->delete();
      session()->flash('success', '用户删除成功！');
      return back();
    }
}
