<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'user_id', 'photo_id',
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id')->select(['id', 'name', 'avatar']);
    }

    public function album(){
        return $this->belongsTo('App\Album', 'album_id')->select(['id', 'title']);
    }

    public function comment(){
        return $this
            ->hasMany('App\Comment', 'photo_id', 'id')
            ->with('user')
            ->select('photo_id', 'content');
    }

    public function like(){
        return $this
            ->hasMany('App\Like', 'photo_id', 'id')
            ->select('id', 'photo_id', 'user_id');
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     Photo::deleting(function($photo)
    //     {   
    //         foreach ($photo->comment as $comment) {
    //             $comment->delete();
    //         }

    //         foreach ($photo->like as $like) {
    //             $like->delete();
    //         }
    //     });
    // }
}
