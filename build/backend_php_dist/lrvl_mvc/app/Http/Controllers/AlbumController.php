<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
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
            'title' => 'required',
            'cover' => 'required|image'
        ]);

        try {
            DB::transaction(function () use ($request) {
                $album = new Album();
                $album->title = $request->title;
                $album->description = $request->description;
                $album->user_id = Auth::user()->id;
                $album->save();

                $photoActions = new PhotoController();
                $photo = $photoActions->save($request, $album->id);

                $album->cover_id = $photo['photo_id'];
                $album->save();
                $album = $album->toArray();
                $album['photo'] = $photo['photo'];
                return json_encode([
                    'result' => 'Альбом создан',
                    'data' => $album
                ]);

                // $file = $request->file('cover');
                // dd($file);
                // $filename = $album->id.'.'.$file->getClientOriginalExtension();
                // $file->move('photos', $filename);
                // $album->cover = '/photos/'.$filename;
                // $album->save();
            });
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }



    public function update($id, Request $request){
        $user = Auth::user();
        $album = Album::find($id);
        if ($user->id != $album->user_id) {
            return ['error' => 'Auth error'];
        }
        $album->title = $request->title;
        $album->description = $request->description;
        $album->save();

        return json_encode([
            'result' => 'Альбом '.$album->name.' обновлен',
            'data' => $album
        ]);
    }



    public function setBackground($id, Request $request){
        $user = Auth::user();
        $album = Album::find($id);
        if ($user->id != $album->user_id) {
            return ['error' => 'Auth error'];
        }
        if ($request->hasFile('cover')) {
            $photoController = new PhotoController();
            $photo = $photoController->save($request, $album->id);
            $album->background_id = $photo['photo_id'];
        }

        $album->name = $request->name;
        $album->descritption = $request->description;
        $album->save();

        return [
            'result' => 'Альбом '.$album->name.' обновлен',
            'data' => $album
        ];
    }



    public function delete($id){
        $album = Album::with('photo')->findOrFail($id);

        $user = Auth::user();
        if ($user->id != $album->user_id) {
            return ['error' => 'Auth error'];
        }

        try {
            if(!empty($album->photo)){
                $picture = $album->photo->img;
                $result = preg_split('|\?.*|', $picture)[0];
                File::delete(public_path().$result);
                Photo::delete($album->photo->id);
            }

            $album->delete();

            return $album;
        } catch (Exception $e) {
            return ['result' => 'Ошибка: '. $e->getMessage()];
        }
    }
}
