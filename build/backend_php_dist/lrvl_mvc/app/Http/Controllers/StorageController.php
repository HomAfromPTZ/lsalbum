<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StorageController extends Controller
{
    public function getLatestPhotos($page){
        $perpage = 6;
        $total = Photo::count();
        $totalpages = $total / $perpage;
        $photos = Photo::with('user')
            ->with('comments')
            ->with('album')
            ->with('likes')
            ->latest()->forPage($page, $perpage)->get();
        $data['total'] = $total;
        $data['totalpages'] = ceil($totalpages);
        $data['photos'] = $photos;
        return $data;
    }



    public function getLatestPhotosCollection($number){
        # code...
    }
}
