<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id')->select(['id', 'name', 'avatar']);
    }

    public function photo(){
        return $this->belongsTo('App\Photo', 'photo_id')->select(['id', 'title']);
    }
}
