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
            <div class="text-center mt-5 top">
               <p class="h2 fade1 fadeUp">ようこそ！AnimalForumへ！</p>
               <p class="h2 fade2 fadeUp">AnimalForumは大切な家族であるペットの写真を共有する掲示板です！🐶🐱</p>
               <p class="h2 fade3 fadeUp">面白い写真や可愛い写真を投稿してみましょう！</p>
               
            </div>
            <div class="d-flex flex-row justify-content-between mt-5">
                <div class="col-md-4 offset-md-2"> {!! link_to_route('signup.get', '登録する！', [], ['class' => 'btn btn-lg btn-info zoomOut']) !!} </div>
                <div class="col-md-4"> {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-info zoomOut']) !!} </div>
            </div>
            <div class="row justify-content-around">
                <img src="{{ asset('images/dog1.png') }}" class="dog mt-5 rounded-circle border border-dark zoomIn">
                <img src="{{ asset("images/mark1.png") }}" class="dog mt-5 rounded-circle border border-dark zoomIn">
            </div>
        </div>
    @endif
@endsection