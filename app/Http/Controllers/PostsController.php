<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;

class PostsController extends Controller
{
    public function index()
    {
        $data = [];
        if(\Auth::check()) {
            $user = \Auth::user();
            
            $posts = $user->feed_microposts()->orderBy("created_at", "desc")->paginate(15);
            
            $data = [
                "user" => $user,
                "posts" => $posts,
                ];
        }
        return view("welcome", $data);
    }
    
    public function store(Request $request)
    {
        
        
        $request->validate([
            "content" => "required|max:255",
            "photo" => ["required", "image", 'mimes:jpeg,png,jpg,bmb,heic'],
            ]);
        
        $image = $request->file("photo");
        
        $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        
        $request->photo = Storage::disk('s3')->url($path);
            
            
        $request->user()->posts()->create([
            "content" => $request->content,
            "photo" => $request->photo,
            ]);
            
            
            return back();
    }
    
    public function destroy($id)
    {
        $post = \App\Post::findOrFail($id);
        
        if(\Auth::id() === $post->user_id) {
            $post->delete();
        } 
        return back();
    }
}
