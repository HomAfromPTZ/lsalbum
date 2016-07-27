<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Comment;
use App\Photo;
use App\Http\Requests;

class CommentController extends Controller
{
    public function save(Request $request, $photo_id){
        $user = Auth::user();
        $user_id = $user->id;
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $user_id;
        $comment->photo_id = $photo_id;
        $comment->save();

        Photo::find($photo_id)->increment('likes');

        return [
            'avatar' => $user->avatar,
            'name' => $user->name,
            'content' => $request->content
        ];
    }


    public function delete(Request $request, $id){
        $comment = Comment::findOrFail($id);
        $user = Auth::user();

        if ($user->id != $comment->user_id) {
            return ['error' => 'Ошибка авторизации'];
        }

        Photo::find($photo_id)->decrement('likes');

        return $comment->delete();
    }
}
