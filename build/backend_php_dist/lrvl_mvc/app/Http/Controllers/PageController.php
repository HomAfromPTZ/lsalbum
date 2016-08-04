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

    public function debug(Request $request){
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

        return view('_backup_home', $data);
    }


    public function home(Request $request){
        $user = Auth::user();
        $data['user'] = $user;
        $data['auth_id'] = $user->id;

        $photos = Photo::latest()
            ->with('user')
            ->with('comment')
            ->with('like')
            ->with('album');
        $data['photos_count'] = $photos->count();
        $data['photos'] = $photos
            ->take(6)
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
        $data['auth_id'] = Auth::user()->id;

        return view('album', $data);
    }


    public function search(Request $request){
        $s = $request->searchtext;

        if($s===""){
            $message = "Пожалуйста, введите поисковый запрос.";
            $photos = array();
        } else {
            if(preg_match("/#\w{3,}/", $s)){
                $photos = Photo::where('description', 'REGEXP', '('.$s.')')
                    ->latest()
                    ->get();
            } else {
                $photos = Photo::where('description', 'LIKE', '%'.$s.'%')
                    ->orWhere('title', 'LIKE', '%'.$s.'%')
                    ->latest()
                    ->get();
            }

            if($photos->count() < 1){
                $message = "По запросу &laquo;".$s."&raquo; совпадений не найдено";
            } else {
                $message = "По запросу &laquo;".$s."&raquo; найдено ".$photos->count()." результатов:";
            }
        }


        $data['user'] = Auth::user();
        $data['auth_id'] = $data['user']->id;
        $data['photos'] = $photos;
        $data['searchtext'] = $s;
        $data['message'] = $message;
        return view('search', $data);
    }
}
