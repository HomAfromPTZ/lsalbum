<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\Http\Requests;

class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $albums = Album::all();
        return $albums;
    }

    public function create(){
        return view('album.create');
    }

    public function save(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'photo' => 'required|image'
        ]);
        try {
            DB::transaction(function () use ($request) {
                $album = new Album();
                $album->title = $request->title;
                $album->user_id = 1;
                $file = $request->file('cover');
                $album->save();
                // dd($file);
                $filename = $album->id.'.'.$file->getClientOriginalExtension();
                $file->move('photos', $filename);
                $album->cover = '/photos/'.$filename;
                $album->save();
            });
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
