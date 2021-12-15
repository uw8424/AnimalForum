@extends("layouts.app")

@section("content")
    
    @if (Auth::check())    
        <div class="row">
            <aside class="col-sm-4">
                {{--ユーザー情報--}}
                @include("users.card")
            </aside>
            <div class="col-sm-8">
                {{-- 投稿フォーム --}}
                @include("posts.form")
                {{-- 投稿一覧 --}}
                @include("posts.posts")
            </div>
        </div>
    @else    
        <div class="center junbotron">
            <div class="text-center">
                <h1 class="top">ようこそ！AnimalForumへ！<br>
                AnimalForumは大切な家族であるペットの写真を共有する掲示板です！🐶🐱<br>
                面白い写真や可愛い写真を投稿してみましょう！
                </h1>
            </div>
            <div class="d-flex flex-row justify-content-between mt-5">
                <div class="col-md-4 offset-md-2"> {!! link_to_route('signup.get', '登録する！', [], ['class' => 'btn btn-lg btn-info ']) !!} </div>
                <div class="col-md-4"> {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-info ']) !!} </div>
            </div>
            <div class="row justify-content-between">
                <img src="{{ asset("storage/images/dog2.jpg") }}" class="dog mt-5">
                <img src="{{ asset("storage/images/mark.jpeg.png") }}" class="dog1 mt-5">
            </div>
        </div>
    @endif
@endsection