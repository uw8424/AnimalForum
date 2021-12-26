@if(count($post->comments) > 0)
    <ul class="list-unstyled">
        @foreach ($post->comments as $comment)
            <li class="post border-info card mt-3">
                 <div class="card-header media row post-header">
                     {{-- プロフィール画像を未登録の場合はデフォルト画像、登録していればその画像を表示 --}}
                     <div class="media-left"><img src="{{ $comment->user->avatar ? Storage::disk('s3')->url($comment->user->avatar) : asset('images/user_default.jpg') }}" class="rounded-circle img-thumbnail post-icon" width="50" height="50"><span class="user-name">{!! link_to_route("users.show", $comment->user->name, ["user" => $comment->user->id]) !!}</span></div>
                     <div class="media-right date ml-2">投稿した日付：{{ $comment->created_at }}</div>
                 </div>
                 <div class="post-body card-body">
                    <div>
                        <div>
                            {{-- 投稿内容 --}}
                            <p class="mb-0">{!! nl2br(e($comment->content)) !!}</p>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="mt-3">
                                {{-- 投稿主であれば削除 --}}
                                @if(Auth::id() === $comment->user_id)
                                {!! Form::open(["route" => ["comment.delete", $comment->id], "method" => "delete"]) !!}
                                    {!! Form::submit("削除", ["class" => "btn btn-danger btn-sm"]) !!}
                                {!! Form::close() !!}
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