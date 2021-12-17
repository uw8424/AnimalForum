@if(count($posts) > 0)
    <ul class="list-unstyled">
        @foreach ($posts as $post)
            <li class="post border-info card mt-3">
                 <div class="card-header d-flex justify-content-between">
                     <div><img src="{{ $post->user->avatar }}" class="rounded-circle img-thumbnail post-icon" width="50" height="50"><span class="user-name">{{$post->user->name}}</span></div>
                     <div>投稿した日付：{{ $post->created_at }}</div>
                 </div>
                 {{-- 投稿した写真 --}}
                 <a href="{{ $post->photo }}" data-lightbox="group"><img src="{{ $post->photo }}" class="post-photo card-img-top"></a>
                 <div class="post-body card-body">
                    <div>
                        <div>
                            <p class="mb-0">{!! nl2br(e($post->content)) !!}</p>
                        </div>
                        <div class="d-flex flex-row">
                            <div>
                                @if(Auth::id() === $post->user_id)
                                {!! Form::open(["route" => ["posts.destroy", $post->id], "method" => "delete"]) !!}
                                    {!! Form::submit("削除", ["class" => "btn btn-danger btn-sm"]) !!}
                                {!! Form::close() !!}
                                @endif
                            </div>
                            <div>
                                @include("user_favorite.favorite_button")
                            </div>
                        </div>    
                    </div> 
                 </div>
            </li>
        @endforeach    
    </ul>
    {{ $posts->links() }}
@endif