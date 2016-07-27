<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function user(){
        return $this
            ->belongsTo('App\User', 'user_id', 'id')
            ->select(['id', 'name', 'avatar']);
    }

    public function photos(){
        return $this
            ->hasMany('App\Photo', 'album_id')
            ->select('id', 'album_id', 'title', 'comments', 'likes','img_url', 'thumb_url');
    }

    public function cover(){
        return $this
            ->hasOne('App\Photo', 'id', 'cover_id')
            ->select('id', 'img_url', 'thumb_url');
    }
}
