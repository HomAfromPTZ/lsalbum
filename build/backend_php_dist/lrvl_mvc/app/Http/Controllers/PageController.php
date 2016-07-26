<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Like;
use App\User;
use App\Comment;
use App\Album;
use App\Photo;
use App\Http\Requests;

class PageController extends Controller
{
    public function index(){
        if(Auth::guest()){
            return view('index');
        } else {
            return redirect('/home');
        }
    }



    public function home(Request $request){
        $user = Auth::user();
        $data['user'] = $user;
        $data['auth_id'] = $user->id;
        $data['photos'] = Photo::latest()
            ->take(6)
            ->with('user')
            ->with('comments')
            ->with('likes')
            ->with('album')
            ->get();
        // dd($data['photos']);
        $data['albums'] = Album::latest()
            ->where('user_id', $user->id)
            ->get();
        $data['url'] = $request->path();
        $data['rawData'] = $data;
        return view('home', $data);
    }



    public function user($id, Request $request){
        $user = User::findOrFail($id);
        $data['user'] = $user;
        $data['url'] = $request->path();
        $data['albums'] = Album::latest()->where('user_id', $user->id);
        $data['auth_id'] = $data['authUser']->id;
        return view('user', $data);
    }



    public function album($id, Request $request){
        $album = Album::find($id);

        $photos = Photo::where('album_id', $id)
            ->latest()
            ->get();

        if($photos->count() < 1){
            abort(404);
        }

        $onePhoto = $photos->first();
        $photoIds = $photos->pluck('id');
        $likes = Like::whereIn('photo_id', $photoIds)->count();
        $comments = Comment::whereIn('photo_id', $photoIds)->count();
        $user = User::find($onePhoto->user_id);

        $data['url'] = $request->path();
        $data['likes'] = $likes;
        return view('album', $data);
    }
}
