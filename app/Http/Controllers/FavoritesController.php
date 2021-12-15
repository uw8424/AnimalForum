<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store($id)
    {
        //閲覧ユーザーがidの投稿をお気に入りする
        \Auth::user()->favorite($id);
        //前のURLへリダイレクト
        return back();
    }
    
    public function destroy($id)
    {
        //閲覧ユーザーがidの投稿のお気に入りを外す
        \Auth::user()->unfavorite($id);
        //前のURLへリダイレクト
        return back();
    }
}
