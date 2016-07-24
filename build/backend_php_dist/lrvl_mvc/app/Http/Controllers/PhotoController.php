<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Album;
use Auth;
use App\Http\Requests;

class PhotoController extends Controller
{
    public function save(Request $request, $album){
        $user = Auth::user()

        $albumdat = Album::find($album);
        if ($user->id != $albumdata->user_id) {
            return ['error' => 'auth error'];
        }

        $this->validate($request, [
            'cover' => 'required|image'
        ]);

        $result = ['status' => 'success'];
        $photo = new Photo();
        $photo->user_id = $user->id;
        $photo->name = "Без названия";
        $photo->album_id = $album;
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
            return ['status'] => 'error'];
        }

        $result['photo_id'] = $photo->id;
        $result['photo'] = $filename;
        $result['thumbnail'] = $thumbnail;

        // TODO: Houston, we have a problem
        $result['num'] = $request->input('num');

        return $result;
    }
}
