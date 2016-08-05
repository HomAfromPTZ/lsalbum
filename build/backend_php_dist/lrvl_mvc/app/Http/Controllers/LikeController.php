<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Like;
use App\Photo;
use App\Http\Requests;

class LikeController extends Controller
{
    public function like(Request $request, $photo_id){
        $user_id = Auth::user()->id;
        $check = Like::where('photo_id', $photo_id)->where('user_id', $user_id)->count();
        if($check == 0){
            $like = new Like();
            $like->photo_id = $photo_id;
            $like->user_id = $user_id;
            $like->save();

            Photo::find($photo_id)->increment('likes');
            return ['result' => 'like'];
        } else {
            Photo::find($photo_id)->decrement('likes');
            Like::where('photo_id', $photo_id)->where('user_id', $user_id)->delete();
            return ['result' => 'unlike'];
        }
    }



    public function unlike(Request $request, $photo_id){
        $user_id = Auth::user()->id;
        Photo::find($photo_id)->decrement('likes');
        return Like::where('photo_id', $photo_id)->where('user_id', $user_id)->delete();
    }
}
