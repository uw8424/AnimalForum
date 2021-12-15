{{--閲覧しているユーザーが対象のユーザーではないなら--}}
@if(Auth::id() != $user->id)
    @if(Auth::user()->is_following($user->id))
        {{-- フォロー外すボタン --}}
        {!! Form::open(["route" => ["users.unfollow", $user->id], "method" => "delete"]) !!}
            {!! Form::submit("フォローを外す", ["class" => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(["route" => ["users.follow", $user->id]]) !!}
            {!! Form::submit("フォロー", ["class" => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif    