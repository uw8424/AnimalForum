<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            "comment" => "string",
            ]);
        
        $post = Post::findOrFail($id);
        
        Comment::create([
            "user_id" => $request->user()->id,
            "post_id" => $request->id,
            "content" => $request->content,
            ]);
            
            return back();
    }
    
    public function index($id)
    {
        //ユーザーのコメントを取得して表示
        $user = User::find($id);
        
        $comments = $post->comments();
        
        return view("posts.comments",[
            "user" => $user,
            "posts" => $comments,
            ]);
    }
    
    public function destroy($id)
    {
        //投稿主であればコメントを削除
        $comment = \App\Comment::findOrFail($id);
        
        if(\Auth::id() === $comment->user_id) {
            $comment->delete();
        } 
        return back();
    }
}
