<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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



    public function home(Request){
        $user = Auth::user();
        $data['user'] = $user;
        $data['auth_id'] = $user->id;
        $data['photos'] = Photo::latest()
            ->take(6)
            ->with('user')
            ->with('comments')
            ->with('likes')
            ->with('album');
        $data['myalbums'] = Album::latest()->where('user_id', $user->id);
        $data['url'] = $request->path();
        return view('home', $data);
    }



    public function user($id, Request $request){
        $user = User::findOrFail($id);
        $data['user'] = $user;
        $data['url'] = $request->path();
        $data['myalbums'] = Album::latest()->where('user_id', $user->id);
        $data['auth_id'] = $data['authUser']->id;
        return view('user', $data);
    }
}
