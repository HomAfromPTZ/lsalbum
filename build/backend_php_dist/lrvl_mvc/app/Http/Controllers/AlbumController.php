<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use File;
use App\Photo;
use App\Album;
use App\Like;
use App\Comment;
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

    // DEBUG ALBUM CREATION (remove on prod)
    public function create(){
        $data['latest_album'] = Album::latest()->first();
        return view('album.create', $data);
    }

    public function save(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'cover' => 'required|image'
        ]);

        try {
            return DB::transaction(function () use ($request) {
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
                $album['cover'] = $photo['photo'];
                $album['thumbnail'] = $photo['thumbnail'];
                return [
                    'status' => 'success',
                    'result' => 'Альбом создан',
                    'id' => $album['id'],
                    'title' => $album['title'],
                    'description' => $album['description'],
                    'cover' => $album['cover'],
                    'data' => $album
                ];
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

        return [
            'status' => 'success',
            'result' => 'Альбом '.$album->name.' обновлен',
            'title' => $album->title,
            'description' => $album->description,
            'cover' => $album->cover->img_url,
            'cover_thumb' => $album->cover->thumb_url,
            'data' => $album
        ];
    }


    public function delete($id){
        $album = Album::with('photos')->findOrFail($id);

        $user = Auth::user();

        if ($user->id != $album->user_id) {
            return ['error' => 'Ошибка авторизации'];
        }

        try {
            if(!empty($album->photos)){
                foreach ($album->photos as $photo) {
                    $main_pic = preg_split('|\?.*|', $photo->img_url)[0];
                    $thumb_pic = preg_split('|\?.*|', $photo->thumb_url)[0];

                    File::delete(public_path($main_pic));
                    File::delete(public_path($thumb_pic));

                    Photo::destroy($photo->id);
                }
            }

            $album->delete();

            return [
                'status' => 'success',
                'data' => $album
            ];
        } catch (Exception $e) {
            return ['result' => 'Ошибка: '. $e->getMessage()];
        }
    }
}
