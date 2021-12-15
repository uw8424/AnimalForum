@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <aside class="col-sm-4">
            @include("users.card")
        </aside>
        <div class="col-sm-8">
            @include("users.navtabs")
            @if(Auth::id() == $user->id)
                @include("posts.form")
            @endif
            @include("posts.posts")
        </div>
    </div>
@endsection