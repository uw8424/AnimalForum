@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>ユーザー登録</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post', "enctype" => "multipart/form-data"]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'なまえ') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label("avatar", "アイコン") !!}
                    {!! Form::file("avatar") !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label("introduction", "自己紹介文") !!}
                    {!! Form::textarea("introduction", null, ["class" => "form-control"]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワード（確認）') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('登録！', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection