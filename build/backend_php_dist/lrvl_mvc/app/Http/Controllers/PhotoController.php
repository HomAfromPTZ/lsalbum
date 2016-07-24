<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Photo;
use App\Album;
use App\Http\Requests;

class PhotoController extends Controller
{
    public function save(Request $request, $album_id){
        $user = Auth::user()

        $albumdata = Album::find($album_id);
        if ($user->id != $albumdata->user_id) {
            return ['error' => 'auth error'];
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
            $file = $request->file('cover')->move('uploads/photos/', $photo->id.'.'.$extension);

            $thumbnail = '/uploads/photos/thumbnails/'.$photo->id.'.'.$extension;
            Image::make($file)->resize(400, null, function($constraint) {
                $constraint->aspectRatio();
            })->save(public_path().$thumbnail);

            $filename = '/'.$file->__toString().'?'.time();

            $photo->img = $filename;

            // TODO: Alter photos table!
            $photo->thumbnail = $thumbnail;

            $photo->save();
        } catch (Exception $e) {
            $photo->delete();
            return ['status' => 'error'];
        }

        $result['photo_id'] = $photo->id;
        $result['photo'] = $filename;
        $result['thumbnail'] = $thumbnail;

        // TODO: Houston, we have a problem
        $result['num'] = $request->input('num');

        return $result;
    }



    public function update(Request $request, $id)
    {
        try {
            $photo = Photo::find($id);

            $user = Auth::user();
            if($user->id != $photo->user_id){
                return ['error' => 'Auth error'];
            }
            $photo->title = $request->input('name');
            $photo->description = $request->input('description');
            $photo->save();
            return [
                'id' => $id,
                'title' => $photo->name,
                'status' => 'Изменения сохранены'
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error'
            ];
        }
    }



    public function delete($id){
        $album = Album::where('background', $id)->first();

        if (empty($album)) {
            $photo = Photo::findOrFail($id);
            $user = Auth::user();

            if($user->id != $photo->user_id){
                return [
                    'errors' => true,
                    'result' => 'Auth error'
                ];
            }

            $result = preg_split('|\?.*|', $photo->img)[0];
            File::delete(public_path().$result);
            $photo->delete();

            return [
                'errors' => false,
                'data' => $photo
            ];
        } else {
            return [
                'result' => 'Эта фотография является обложкой. Сначала измените её.',
                'errors' => true
            ];
        }
    }
}
