<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["content", "photo"];
    
    //Userモデルとの関係を定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //お気に入りに関係するUserモデルとの関係を定義
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, "post_favorite", "post_id", "user_id");
    }
}
