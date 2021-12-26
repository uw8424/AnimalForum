<ul class="nav nav-tabs nav-justified">
    {{-- ユーザ詳細タブ --}}
    <li class="nav-item">
        <a href="{{ route("users.show", ["user" => $user->id]) }}" class="nav-link {{Request::routeIs("users.show") ? "active" : ""}}">
           タイムライン
           <span class="badge badge-secondary">{{ $user->posts_count }}</span>
        </a>
    </li>
    {{-- フォロー一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route("users.followings",["id" => $user->id]) }}" class="nav-link {{ Request::routeIs("users.followings") ? "active" : "" }}">
            フォロー
            <span class="badge badge-secondary">{{ $user->followings_count }}</span>
        </a>
    </li>
    {{-- フォロワー一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route("users.followers", ["id" => $user->id]) }}" class="nav-link {{ Request::routeIs("users.followers") ? "active" : "" }}">
            フォロワー
            <span class="badge badge-secondary">{{ $user->followers_count }}</span>
        </a>
    </li>
    {{-- お気に入り一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route("users.favorites", ["id" => $user->id]) }}" class="nav-link {{Request::routeIs("users.favorites") ? "active" : "" }}">
        おきにいり
        <span class="badge badge-secondary">{{ $user->favorites_count }}</span>
        </a>
    </li>
</ul>