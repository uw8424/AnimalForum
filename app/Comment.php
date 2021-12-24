<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["content","post_id","user_id"];
    
    //Postモデルとの関係を定義
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    //Userモデルとの関係を定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }    
    
}
