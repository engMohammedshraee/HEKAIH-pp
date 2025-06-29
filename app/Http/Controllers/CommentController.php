<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request)
{
    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    $comment = Comment::create([
        'user_id' =>$request->user_id ,
        'card_id' => $request->story_id,
        'content' => $request->content,
        'commentdepartment'=>$request->commentdepartment
    ]);

    return back();
}

}
