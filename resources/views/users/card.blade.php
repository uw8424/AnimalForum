 <div class="card">
        <div class="card-header">
            {{-- ユーザー名 --}}
        <h3 class="card-title">{{ $user->name }}</h3>
        </div>
        <div class="card-body">
            {{-- ユーザーが登録の際に投稿した画像を表示。登録していなければデフォルト画像 --}}
            <img src="{{ $user->avatar ? Storage::disk('s3')->url($user->avatar) : asset('images/user_default.jpg') }}" class="rounded-circle show-icon img-thumbnail ml-5">
        </div>
        <div class="border">
            {{-- 登録の際に記述した自己紹介文 --}}
            <p class="h4">{{ $user->introduction }}</p>
        </div>
        {{-- フォローボタン --}}
        @include("user_follow.follow_button")
</div>