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
            return view('auth.login');
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
            ->with('comment')
            ->with('like')
            ->with('album')
            ->get();
        $data['albums'] = Album::latest()
            ->where('user_id', $user->id)
            ->with('cover')
            ->get();
        $data['url'] = $request->path();

        return view('home', $data);
    }



    public function user(Request $request, $id){
        $user = User::findOrFail($id);
        $data['user'] = $user;
        $data['url'] = $request->path();
        $data['albums'] = Album::latest()
            ->where('user_id', $user->id)
            ->take(6)
            ->get();
        $data['auth_id'] = $data['user']->id;

        return view('user', $data);
    }



    public function album(Request $request, $id){
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
        $data['user'] = $user;
        $data['album'] = $album;
        $data['photos'] = $photos;
        $data['photos_num'] = $photos->count();
        $data['likes_num'] = $likes;
        $data['comments_num'] = $comments;

        return view('album', $data);
    }


    public function search(Request $request){
        $s = $request->searchtext;

        $photos = Photo::where('description', 'LIKE', '%'.$searchtext)
            ->latest()
            ->get();

        if($photos->count() < 1){
            return [
                'status' => 'error',
                'message' => 'Совпадений не найдено'
            ];
        }

        $data['photos'] = $photos;

        return view('search', $data);
    }
}
