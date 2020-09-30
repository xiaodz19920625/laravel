<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content'
    ];
    //一对一关联
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
