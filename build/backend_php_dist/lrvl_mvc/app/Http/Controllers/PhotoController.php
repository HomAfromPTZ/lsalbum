<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use Image;
use App\Photo;
use App\Album;
use App\Http\Requests;

class PhotoController extends Controller
{
    public function index(){
        $photos = Photo::all();
        return $photos;
    }


    public function create(){
        $data['latest_album'] = Album::latest()->first();
        $data['latest_photo'] = Photo::latest()->first();
        return view('photo.create', $data);
    }



    public function save(Request $request, $album_id){
        $user = Auth::user();

        $albumdata = Album::find($album_id);
        if ($user->id != $albumdata->user_id) {
            return ['error' => 'Ошибка авторизации'];
        }

        $this->validate($request, [
            'cover' => 'required|image'
        ]);

        $result = ['status' => 'success'];
        $photo = new Photo();
        $photo->user_id = $user->id;
        $photo->title = "Без названия";

        $photo->album_id = $album_id;
        $photo->save();
        try {
            $extension = File::extension($request->file('cover')->getClientOriginalName());
            $file = $request->file('cover')->move('uploads/photos', $photo->id.'.'.$extension);

            $thumbnail_path = 'uploads/photos/thumbnails/';
            $thumbnail = $thumbnail_path.$photo->id.'.'.$extension;

            File::exists(public_path($thumbnail_path))
            or File::makeDirectory(public_path($thumbnail_path));

            Image::make($file)->resize(400, null, function($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($thumbnail));

            $filename = '/'.$file->getPathname().'?'.time();
            $thumbnail = '/'.$thumbnail.'?'.time();

            $photo->img_url = $filename;
            $photo->thumb_url = $thumbnail;

            $photo->save();
        } catch (Exception $e) {
            $photo->delete();
            return ['status' => 'error'];
        }

        $result['photo_id'] = $photo->id;
        $result['photo'] = $filename;
        $result['thumbnail'] = $thumbnail;
        $result['num'] = $request->num;

        return $result;
    }



    public function update(Request $request, $id)
    {
        try {
            $photo = Photo::find($id);

            $user = Auth::user();
            if($user->id != $photo->user_id){
                return ['error' => 'Ошибка авторизации'];
            }
            $photo->title = $request->title;
            $photo->description = $request->description;
            $photo->save();
            return [
                'id' => $id,
                'title' => $photo->title,
                'status' => 'Изменения сохранены'
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error'
            ];
        }
    }



    public function delete($id){
        $album = Album::where('cover_id', $id)->first();

        if (empty($album)) {
            $photo = Photo::findOrFail($id);
            $user = Auth::user();

            if($user->id != $photo->user_id){
                return [
                    'errors' => true,
                    'result' => 'Auth error'
                ];
            }

            $main_pic = preg_split('|\?.*|', $photo->img_url)[0];
            $thumb_pic = preg_split('|\?.*|', $photo->thumb_url)[0];

            File::delete(public_path($main_pic));
            File::delete(public_path($thumb_pic));

            $photo->delete();

            return [
                'errors' => false,
                'data' => $photo
            ];
        } else {
            return [
                'result' => 'Эта фотография является обложкой. Сначала измените или удалите её.',
                'errors' => true
            ];
        }
    }
}
