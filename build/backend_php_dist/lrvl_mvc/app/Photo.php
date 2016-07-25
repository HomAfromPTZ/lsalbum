<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo('App\User')->select(['id', 'name', 'avatar']);
    }

    public function album(){
        return $this->belongsTo('App\User')->select(['id', 'title']);
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'photo_id', 'id')->with('user');
    }

    public function likes(){
        return $this->hasMany('App\Like', 'photo_id', 'id')->with('user');
    }
}
