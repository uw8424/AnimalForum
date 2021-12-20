<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "PostsController@index");

Route::get("signup", "Auth\RegisterController@showRegistrationForm")->name("signup.get");
Route::post("signup", "Auth\RegisterController@register")->name("signup.post");

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(["middleware" => ["auth"]], function () {
    Route::group(["prefix" => "users/{id}"], function () {
       Route::post("follow", "UserFollowController@store")->name("users.follow");
       Route::delete("unfollow", "UserFollowController@destroy")->name("users.unfollow");
       Route::get("followings", "UsersController@followings")->name("users.followings");
       Route::get("followers", "UsersController@followers")->name("users.followers");
       Route::get("favorites", "UsersController@favorites")->name("users.favorites");
    });
    Route::resource("users", "UsersController", ["only" => ["index", "show"]]);
    
    Route::group(["prefix" => "posts/{id}"], function () {
        Route::post("favorite","FavoritesController@store")->name("favorites.favorite");
        Route::delete("unfavorire", "FavoritesController@destroy")->name("favorites.unfavorite");
    });
    
    Route::resource("posts", "PostsController", ["only" => ["store", "destroy","edit","update",]]);
});