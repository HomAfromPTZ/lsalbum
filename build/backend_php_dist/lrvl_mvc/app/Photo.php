<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id')->select(['id', 'name', 'avatar']);
    }

    public function album(){
        return $this->belongsTo('App\Album', 'album_id')->select(['id', 'title']);
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'photo_id', 'id')->with('user');
    }

    public function likes(){
        return $this->hasMany('App\Like', 'photo_id', 'id')->with('user');
    }

}
