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
            //ログイン中のユーザー
            $user = \Auth::user();
            //投稿を読み込み、日付毎に降順で取得。
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
        // 送信された内容に”photo”が存在していればs3にアップロード
        if($request->has("photo")){
        $image = $request->file("photo");
        // バケットの"myprefix"フォルダへアップロード
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
        //投稿主であれば投稿を削除
        $post = \App\Post::findOrFail($id);
        
        if(\Auth::id() === $post->user_id) {
            $post->delete();
        } 
        return back();
    }
    
    public function edit($id)
    {
        //投稿主であれば投稿を編集
        $post = Post::findOrFail($id);
        
        return view("posts.edit",[
            "post" => $post,
            ]);
    }
    
    public function update(Request $request, $id)
    {
         $request->validate([
            "content" => "required|max:255",
            "photo" => "required|image"
            ]);
        //editで編集した内容を送信する処理
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
