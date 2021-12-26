@if(count($posts) > 0)
    <ul class="list-unstyled">
        @foreach ($posts as $post)
            <li class="post border-info card mt-3">
                 <div class="card-header media row post-header">
                     <div class="media-left"><img src="{{ $post->user->avatar ? Storage::disk('s3')->url($post->user->avatar) : asset('images/user_default.jpg') }}" class="rounded-circle img-thumbnail post-icon" width="50" height="50"><span class="user-name">{{$post->user->name}}</span></div>
                     <div class="media-right date ml-2">投稿した日付：{{ $post->created_at }}</div>
                 </div>
                 {{-- 投稿した写真 --}}
                 <a href="{{ $post->photo }}" data-lightbox="group"><img src="{{ $post->photo }}" class="post-photo card-img-top"></a>
                 <div class="post-body card-body">
                    <div>
                        <div>
                            <p class="mb-0">{!! nl2br(e($post->content)) !!}</p>
                        </div>
                        <div class="comment-post mt-3">
                            {!! Form::open(["route" => ["posts.comment", $post->id], "method" => "post"]) !!}
                                {!! Form::textarea("content", null, ["class" => "form-control", "rows" => "2", "placeholder" => "コメントを入力"]) !!}
                                {!! Form::submit("送信", ["class" => "btn btn-info btn-sm"]) !!}
                            {!! Form::close() !!}    
                        </div>
                        <div class="comment">
                            @include("posts.comments")
                        </div>
                        <div class="d-flex flex-row">
                            <div class="mt-3">
                                @if(Auth::id() === $post->user_id)
                                {!! Form::open(["route" => ["posts.destroy", $post->id], "method" => "delete"]) !!}
                                    {!! Form::submit("削除", ["class" => "btn btn-danger btn-sm"]) !!}
                                {!! Form::close() !!}
                                @endif
                            </div>
                            <div class="mt-2">
                                @include("user_favorite.favorite_button")
                            </div>
                            <div class="mt-3">
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