{!! Form::open(["route" => "posts.store", "enctype" => "multipart/form-data"]) !!}
    <div class="form-group">
        {!! Form::textarea("content", null, ["class" => "form-control", "rows" => "2", "placeholder" => "投稿内容をここに入力"]) !!}
    </div>
    <div class="form-group">
        {!! Form::label("photo", "写真🐶📷🐱") !!}
        {!! Form::file("photo") !!}
    </div>
{!! Form::submit("送信",["class" => "btn btn-info"]) !!}
{!! Form::close() !!}