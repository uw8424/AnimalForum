<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;

use App\Post;

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
            "photo" => "required|image"
            ]);
        
        if($request->has("photo")){
        $image = $request->file("photo");
        
        $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        
        $request->photo = Storage::disk('s3')->url($path);
        
        }
            
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
    
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        
        return view("posts.edit",[
            "post" => $post,
            ]);
    }
    
    public function update(Request $request, $id)
    {
        
        
        $post = Post::findOrFail($id);
        
        $image = $request->file("photo");
        
        $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        
        $request->photo = Storage::disk('s3')->url($path);
        
        $post->content = $request->content;
        $post->photo = $request->photo;
        
        $post->save();
        
        return redirect("/");
    }
    
    public function comment(Request $request)
    {
        $request->validate([
            "content" => "string",
            ]);
            
        $request->user()->posts()->create([
            "content" => $request->content,
            "user_id" => $request->user()->id,
            "comment_id" => $request->post_id,
            ]);
            
        return back();
    }
}
