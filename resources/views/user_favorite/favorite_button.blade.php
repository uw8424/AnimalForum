    @if(Auth::user()->is_favorites($post->id))
        {{-- お気に入り外すボタン --}}
        {!! Form::open(["route" => ["favorites.unfavorite", $post->id], "method" => "delete"]) !!}
            {!! Form::button('<i class="fas fa-heart fa-2x"></i>',["class" => "btn heart", "type" => "submit"])!!}
        {!! Form::close() !!}
    @else
        {{-- お気に入りボタン --}}
        {!! Form::open(["route" => ["favorites.favorite", $post->id]]) !!}
            {!! Form::button('<i class="far fa-heart fa-2x"></i>',["class" => "btn heart", "type" => "submit"])!!}
        {!! Form::close() !!}
    @endif