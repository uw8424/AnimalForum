@if(count($posts) > 0)
    <ul class="list-unstyled">
        @foreach ($posts as $post)
            <li class="post border-info card mt-3">
                 <div class="card-header media row post-header">
                     {{-- ユーザーが登録の際に投稿した画像を表示。登録していなければデフォルト画像 --}}
                     <div class="media-left"><img src="{{ $post->user->avatar ? Storage::disk('s3')->url($post->user->avatar) : asset('images/user_default.jpg') }}" class="rounded-circle img-thumbnail post-icon" width="50" height="50"><span class="user-name">{!! link_to_route("users.show", $post->user->name, ["user" => $post->user->id]) !!}</span></div>
                     <div class="media-right date ml-2">投稿した日付：{{ $post->created_at }}</div>
                 </div>
                 {{-- 投稿した写真 --}}
                 <a href="{{ $post->photo }}" data-lightbox="group"><img src="{{ $post->photo }}" class="post-photo card-img-top"></a>
                 <div class="post-body card-body">
                    <div>
                        <div>
                            {{-- 投稿内容 --}}
                            <p class="mb-0">{!! nl2br(e($post->content)) !!}</p>
                        </div>
                        {{-- コメントを送信するボタン --}}
                        <div class="comment-post mt-3">
                            {!! Form::open(["route" => ["posts.comment", $post->id], "method" => "post"]) !!}
                                {!! Form::textarea("content", null, ["class" => "form-control", "rows" => "2", "placeholder" => "コメントを入力"]) !!}
                                {!! Form::submit("送信", ["class" => "btn btn-info btn-sm"]) !!}
                            {!! Form::close() !!}    
                        </div>
                        <div class="comment">
                            {{-- コメントを表示 --}}
                            @include("posts.comments")
                        </div>
                        <div class="d-flex flex-row">
                            <div class="mt-3">
                                {{-- 投稿主であれば削除 --}}
                                @if(Auth::id() === $post->user_id)
                                {!! Form::open(["route" => ["posts.destroy", $post->id], "method" => "delete"]) !!}
                                    {!! Form::submit("削除", ["class" => "btn btn-danger btn-sm"]) !!}
                                {!! Form::close() !!}
                                @endif
                            </div>
                            <div class="mt-2">
                                {{-- お気に入りボタン --}}
                                @include("user_favorite.favorite_button")
                            </div>
                            <div class="mt-3">
                                {{-- 投稿主であれば編集 --}}
                                @if(Auth::id() === $post->user_id)
                                    {!! link_to_route("posts.edit", "編集", ["post" => $post->id], ["class" => "btn btn-info btn-sm"]) !!}
                                @endif
                            </div>
                        </div>    
                    </div> 
                 </div>
            </li>
        @endforeach    
    </ul>
    {{ $posts->links() }}
@endif