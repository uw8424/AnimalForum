<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',"avatar","introduction",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function posts()
    {
        //Postモデルとの関係を定義
        return $this->hasMany(Post::class);
    }
        //投稿数のカウント
    public function loadRelationshipCounts()
    {
        $this->loadCount(["posts", "followings", "followers", "favorites"]);
    }
        //フォローしているユーザーの取得
    public function followings()
    {
        return $this->belongsToMany(User::class, "user_follow", "user_id", "follow_id")->withTimestamps();
    }
        //自分をフォローしている人の取得
    public function followers()
    {
        return $this->belongsToMany(User::class, "user_follow", "follow_id", "user_id")->withTimestamps();
    }
    
        //ユーザーをフォローする
    public function follow($userId)
    {
        //既にフォローしているかの確認
        $exist = $this->is_following($userId);
        //対象が自分かどうかの確認
        $its_me = $this->id == $userId;
        
        if($exist || $its_me) {
            //既にフォローしていれば何もしない
            return false;
        } else {
            //フォローしていないならフォローする
            $this->followings()->attach($userId);
            return true;
        }    
    }
        //ユーザーのフォローを外す
    public function unfollow($userId)
    {
        //既にフォローしているかの確認
        $exist = $this->is_following($userId);
        //対象が自分かどうかの確認
        $its_me = $this->id == $userId;
        
        if($exist || $its_me) {
            //既にフォローしているならフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            //フォローしていないなら何もしない
            return false;
        }
    }
    
    public function is_following($userId)
    {
        //フォロー中のユーザーの中に$userIdのものが存在するか
        return $this->followings()->where("follow_id", $userId)->exists();
    }
    
    //自分のタイムラインにフォロー中のユーザーの投稿も表示する
    public function feed_microposts()
    {
        //このユーザーがフォロー中のユーザーのidを取得して配列にする
        $userIds = $this->followings()->pluck("users.id")->toArray();
        //このユーザーのidもその配列に追加する
        $userIds[] = $this->id;
        //それらのユーザーが所有する投稿に絞り込む
        return Post::whereIn("user_id", $userIds);
    }
    //お気に入りに関係するPostモデルとの関係を定義
    public function favorites()
    {
        return $this->belongsToMany(Post::class, "post_favorite", "user_id", "post_id");
    }
    
    public function favorite($postId)
    {
        //既にお気に入りしているかの確認
        $exist = $this->is_favorites($postId);
        
        if($exist) {
            //既にお気に入りしていれば何もしない
            return false;
        } else {
            //お気に入りしていないならする
            $this->favorites()->attach($postId);
            return true;
        }
    }
    
    public function unfavorite($postId)
    {
        //既にお気に入りしているかの確認
        $exist = $this->is_favorites($postId);
        
        if($exist) {
            //既にお気に入りしていれば外す
            $this->favorites()->detach($postId);
            return true;
        } else {
            //お気に入りしていないなら何もしない
            return false;
        }
    }
    
    public function is_favorites($postId)
    {
        return $this->favorites()->where("post_id", $postId)->exists();
    }
    
    public function comments()
    {
        //Commentモデルとの関係を定義
        return $this->hasMany(Comment::class);
    }
}
