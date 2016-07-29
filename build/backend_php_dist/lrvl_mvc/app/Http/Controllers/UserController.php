<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use App\Http\Requests;

class UserController extends Controller
{
    public function saveData(Request $request){
        try {
            $user = Auth::user();
            $result = ['status'=>'success', 'message'=>'Данные сохранены'];

            if ($request->hasFile('avatar')) {
                $extension = File::extension($request->file('avatar')->getClientOriginalName());
                $avatar = $request->file('avatar')->move('uploads/avatars/',$user->id.".".$extension);
                $filename = '/'.$avatar->__toString().'?'.time();
                $filename = str_replace('\\', '/', $filename);
                $user->avatar = $filename;
                $result['avatar'] = $filename;
            }

            if ($request->hasFile('background')) {
                $extension = File::extension($request->file('background')->getClientOriginalName());
                $background = $request->file('background')->move('uploads/backgrounds/',$user->id.".".$extension);
                $filename = '/'.$background->__toString().'?'.time();
                $filename = str_replace('\\', '/', $filename);
                $user->background = $filename;
                $result['background'] = $filename;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->description = $request->description;
            $user->vk = $request->vk;
            $user->facebook = $request->facebook;
            $user->google = $request->google;
            $user->twitter = $request->twitter;
            $user->instagram = $request->instagram;

            $user->save();
            return $result;
        } catch (Exception $e) {
            $result = ['status'=>'error', 'message'=>'Ошибка сохранения данных'];
            return $result;
        }
    }
}
