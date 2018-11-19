<div class="container">
<h1>{{ "/" . $board->name_short . "/ - " . $board->name }}</h1>
<p>{{ "Количество постов: " . $board->last_post_num . ". Количество тредов: " . $threads->count() }}</p>
    <ul>
        @foreach ($threads as $thread)
        <h3 style="color: red;">
            {{ $thread->title . "     №" . $thread->num . "  " . $thread->created_at . " IP: " . $thread->poster_ip }}
        </h3>
            <p>{{ $thread->text }}</p>
            <a href="{{ route('threads.show', [$board->name_short, $thread->num]) }}">В тред</a>
            <div class="container">
                @foreach ($thread->lastPosts() as $post)
                    <h4>
                        {{ "Anonymous №" . $post->num . "  " . $post->created_at . " IP: " . $post->poster_ip }}
                    </h4>
                    <p>{{ $post->text }}</p>
                @endforeach
            </div>
        @endforeach
    </ul>
</div>
<form method="POST" action="{{ route('threads.create', $board->name_short) }}">
@csrf  
    <input type="text" name="title" />
    <input type="text" name="text" />
    <input type="submit" />
</form>