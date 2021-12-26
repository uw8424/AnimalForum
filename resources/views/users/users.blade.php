@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach($users as $user)
            <li class="media row">
                {{-- ユーザーが登録の際に投稿した画像を表示。登録していなければデフォルト画像 --}}
                <div class="col-8"><div class="media-left"><img src="{{ $user->avatar ? Storage::disk('s3')->url($user->avatar) : asset('images/user_default.jpg') }}" class="rounded-circle img-thumbnail"></div>
                    <div class="media-body">
                        {{-- ユーザー名 --}}
                        <div>{{ $user->name }}</div>
                        <div>{!! link_to_route("users.show", "プロフィール", ["user" => $user->id]) !!}</div>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    @if(Auth::id() != $user->id)
                        @if(Auth::user()->is_following($user->id))
                            {{-- フォロー外すボタン --}}
                            {!! Form::open(["route" => ["users.unfollow", $user->id], "method" => "delete"]) !!}
                                {!! Form::submit("フォローを外す", ["class" => "btn btn-danger btn-block follow-delete"]) !!}
                            {!! Form::close() !!}
                        @else
                            {{-- フォローボタン --}}
                            {!! Form::open(["route" => ["users.follow", $user->id]]) !!}
                                {!! Form::submit("フォロー", ["class" => "btn btn-primary btn-block"]) !!}
                            {!! Form::close() !!}
                        @endif
                    @endif    
                </div>
            </li>
        @endforeach    
    </ul>
    {{-- ページネーション --}}
    {{ $users->links()  }}
@endif    