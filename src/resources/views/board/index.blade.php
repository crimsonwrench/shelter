<div class="container">
    <ul>
        @foreach ($boards as $board)
            <li><a href="{{ "/". $board->name_short }}">{{ "/" . $board->name_short . "/ - " . $board->name }}</a></li>
        @endforeach
    </ul>
</div>