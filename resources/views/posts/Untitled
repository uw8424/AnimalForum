@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach($users as $user)
            <li class="post">
                <img src="{{ $user->avatar }}" class="rounded-circle img-thumbnail">
                <div class="post-user">
                    <div>{{ $user->name }}</div>
                </div>
                <div>
                    {{-- ユーザー詳細ページへのリンク --}}
                    <p>{!! link_to_route("users.show", "プロフィール", ["user" => $user->id]) !!}</p>
                </div>
            </li>
        @endforeach    
    </ul>
    {{-- ページネーション --}}
    {{ $users->links()  }}
@endif    