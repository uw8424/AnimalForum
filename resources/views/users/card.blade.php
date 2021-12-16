 <div class="card">
        <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
        </div>
        <div class="card-body">
            {{-- ユーザーが登録の際に投稿した画像を表示 --}}
            <img src="{{ $user->avatar }}" class="rounded-circle show-icon img-thumbnail ml-5">
        </div>
        {{-- フォローボタン --}}
        @include("user_follow.follow_button")
</div>