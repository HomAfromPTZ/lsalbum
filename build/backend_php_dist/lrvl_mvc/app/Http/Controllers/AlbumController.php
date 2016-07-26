<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use File;
use App\Photo;
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
                // dd($album);
                $photoActions = new PhotoController();
                $photo = $photoActions->save($request, $album->id);

                $album->cover_id = $photo['photo_id'];
                $album->save();
                $album = $album->toArray();
                $album['cover'] = $photo['photo'];
                $album['thumbnail'] = $photo['thumbnail'];
                return json_encode([
                    'result' => 'Альбом создан',
                    'data' => $album
                ]);
            });
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }



    public function update($id, Request $request){
        $user = Auth::user();
        $album = Album::find($id);

        if ($user->id != $album->user_id) {
            return ['error' => 'Ошибка авторизации'];
        }

        if ($request->hasFile('cover')) {
            $photoActions = new PhotoController();
            $photo = $photoActions->save($request, $album->id);
            $album->cover_id = $photo['photo_id'];
        }

        $album->title = $request->title;
        $album->description = $request->description;
        $album->save();

        return json_encode([
            'result' => 'Альбом '.$album->name.' обновлен',
            'data' => $album
        ]);
    }



    // public function setBackground(Request $request, $id){
    //     $user = Auth::user();
    //     $album = Album::find($id);

    //     if ($user->id != $album->user_id) {
    //         return ['error' => 'Ошибка авторизации'];
    //     }

    //     if ($request->hasFile('cover')) {
    //         $photoActions = new PhotoController();
    //         $photo = $photoActions->save($request, $album->id);
    //         $album->cover_id = $photo['photo_id'];
    //     }

    //     $album->title = $request->title;
    //     $album->description = $request->description;
    //     $album->save();

    //     return [
    //         'result' => 'Альбом '.$album->name.' обновлен',
    //         'data' => $album
    //     ];
    // }



    public function delete($id){
        $album = Album::with('photos')->findOrFail($id);

        $user = Auth::user();

        if ($user->id != $album->user_id) {
            return ['error' => 'Ошибка авторизации'];
        }

        try {
            if(!empty($album->photos)){
                foreach ($album->photos as $photo) {
                    $picture = $photo->img_url;
                    $result = preg_split('|\?.*|', $picture)[0];
                    File::delete(public_path().$result);
                    Photo::destroy($photo->id);
                }
            }

            $album->delete();

            return $album;
        } catch (Exception $e) {
            return ['result' => 'Ошибка: '. $e->getMessage()];
        }
    }
}
