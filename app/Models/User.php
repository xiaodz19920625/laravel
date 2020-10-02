<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar','activation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //一对多关联
    public function statuses(){

        return $this->hasMany(Status::class);
    }

    //首页数据加载
    public function feed(){
        return Status::orderBy('created_at','desc');
    }

    /**
     * 获取粉丝
     * belongsToMany 多对多关联函数
     * 
     */
    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id')->withTimestamps();
    }
    /**
     * 获取关注的人
     * belongsToMany 多对多关联函数
     * 
     */
    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id')->withTimestamps();
    }

    /**
     * 判断当前登陆用户是否关注了某用户
     */
    public function isFollowing($user_id){
        //判断某用户是否在当前登录用户的关注人列表上
        return $this->followings->contains($user_id);
    }

    /**
     * 关注
     */
    public function follow($user_ids){
        // $user_ids应为ID数组
        if(!is_array($user_ids)){
            // 不为数组则转换
            $user_ids = compact('user_ids');
        }
        // sync则添加关联ID,第二参数false不做移除关注其他ID，默认为true则移除
        $this->followings()->sync($user_ids, false);
    }

    /**
     * 取消关注
     */
    public function unfollow($user_ids){
        // $user_ids应为ID数组
        if(!is_array($user_ids)){
            // 不为数组则转换
            $user_ids = compact('user_ids');
        }
        //detach取消关联
        $this->followings()->detach($user_ids);
    }
}
