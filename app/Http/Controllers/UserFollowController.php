<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function store($id)
    {
        //閲覧ユーザーがidのユーザーをフォローする
        \Auth::user()->follow($id);
        //前のURLへリダイレクト
        return back();
    }
    
    public function destroy($id)
    {
        //閲覧ユーザーがidのユーザーのフォローを外す
        \Auth::user()->unfollow($id);
        //前のURLへリダイレクト
        return back();
    }
}
