<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo('App\User')->select(['id', 'name', 'avatar']);
    }

    public function photos(){
        return $this->hasMany('App\Photo')->select(['id', 'title', 'comments', 'likes']);
    }
}
