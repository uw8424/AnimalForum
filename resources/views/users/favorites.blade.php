@extends("layouts.app")

@section("content")
    <div class="row mt-5">
        <aside class="col-sm-4">
            {{-- ユーザー情報 --}}
            @include("users.card")
        </aside>
        <div class="col-sm-8">
            {{-- タブ --}}
            @include("users.navtabs")
            {{-- ユーザー一覧 --}}
            @include("users.favorite")
        </div>
    </div>
@endsection    