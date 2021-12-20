@extends("layouts.app")

@section("content")

    <p class="text-center h2 mt-3">編集ページ</p>
    
    <div class="row">
        <div class="col-sm-6 offset-sm-3 mt-5">
            {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {!! Form::textarea("content", null, ["class" => "form-control", "rows" => "2", "placeholder" => "投稿内容をここに入力"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("photo", "写真🐶📷🐱") !!}
                    {!! Form::file("photo") !!}
                </div>
                
                {!! Form::submit("更新",["class" => "btn btn-info"]) !!}
            {!! Form::close() !!}    
        </div>
    </div>
@endsection    