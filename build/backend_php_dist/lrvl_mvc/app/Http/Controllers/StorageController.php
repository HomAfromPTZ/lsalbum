<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Album;
use App\Http\Requests;

class StorageController extends Controller
{
    public function getLatestPhotos($pagenum){
        $perpage = 6;
        $total = Photo::count();
        $totalpages = $total / $perpage;
        $photos = Photo::with('user')
            ->with('album')
            ->with('comment')
            ->with('like')
            ->latest()
            ->forPage($pagenum, $perpage)
            ->get();
        $data['total'] = $total;
        $data['totalpages'] = ceil($totalpages);
        $data['photos'] = $photos;
        return $data;
    }



    public function getLatestPhotosCollection($number){
        $photos = Photo::with('user')
            ->with('album')
            ->with('comment')
            ->with('like')
            ->latest()
            ->take($number)
            ->get();

        $data['photos'] = $photos;
        return $data;
    }


    public function getAlbumPhotos($id){
        $album = Album::find($id);

        $photos = Photo::where('album_id', $id)
            ->latest()
            ->get();

        if($photos->count() < 1){
            return [
                'status'=> 'error',
                'message'=> 'Нет фотографий',
            ];
        }

        $data['album'] = $album;
        $data['photos'] = $photos;

        return $data;
    }
}
