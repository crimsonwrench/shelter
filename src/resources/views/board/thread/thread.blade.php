<h1>{{ "/" . $board->name_short . "/ - " . $board->name }}</h1>
<div class="container">
    <h3 style="color: red;">
        {{ $thread->title . "     №" . $thread->num . "  " . $thread->created_at . " IP: " . $thread->poster_ip }}
    </h3>
    <p>{{ $thread->text }}</p>
</div>
<div class="container">
    @foreach ($posts as $post)
    <h4>
        {{ "Anonymous №" . $post->num . "  " . $post->created_at . " IP: " . $post->poster_ip }}
    </h4>
    <p>{{ $post->text }}</p>
        @endforeach
</div>
<form method="POST" action="{{ Request::route('newPost') }}">
    @csrf
    <input type="text" name="text" />
    <input type="submit" />
</form>