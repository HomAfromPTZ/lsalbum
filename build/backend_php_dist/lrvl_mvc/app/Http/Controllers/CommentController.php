<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Comment;
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

        return [
            'avatar' => $user->avatar,
            'name' => $user->name,
            'content' => $request->content
        ];
    }
}
