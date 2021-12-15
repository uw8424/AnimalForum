<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        //ユーザー一覧を降順で取得
        $users = User::orderBy("id", "desc")->paginate(10);
        
        return view("users.index", [
            "users" => $users,
            ]);
    }
    
    public function show($id)
    {
        //ユーザー一覧を降順で取得
        $user = User::findOrFail($id);
        //関係するモデルの件数を読み込む
        $user->loadRelationshipCounts();
        
        $posts = $user->posts()->orderBy("created_at", "desc")->paginate(15);
        
        return view("users.show", [
            "user" => $user,
            "posts" => $posts,
            ]);
    }
    
    public function followings($id)
    {
        //ユーザー一覧を降順で取得
        $user = User::findOrFail($id);
        //関係するモデルの件数を読み込む
        $user->loadRelationshipCounts();
        //ユーザーのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);
        
        return view("users.followings",[
            "user" => $user,
            "users" => $followings,
            ]);
    }
    
    public function followers($id)
    {
        //ユーザー一覧を降順で取得
        $user = User::findOrFail($id);
        //関係するモデルの件数を読み込む
        $user->loadRelationshipCounts();
        //ユーザーのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);
        
        return view("users.followers",[
            "user" => $user,
            "users" => $followers,
            ]);
    }
    
    public function favorites($postId)
    {
        //ユーザー一覧を降順で取得
        $user = User::findOrFail($postId);
        //関係するモデルの件数を読み込む
        $user->loadRelationshipCounts();
        //ユーザーのお気に入り一覧を取得
        $favorites = $user->favorites()->paginate(10);
        
        return view("users.favorites",[
            "user" => $user,
            "posts" => $favorites,
            ]);
    }
}
