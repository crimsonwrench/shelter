<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ "/" . $board->name_short . "/ - " . $board->name }}</title>
    <link href="{{ asset('css/oneboard.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="wrapper">
    <header></header>
    <main>
    <div class="s">
        <div class="info">
            <div class="metrics"></div>
            <div class="random">

            </div>
        </div>
        <div class="board">
        @foreach($threads as $thread)

            <div class="thread">
                <div class="d">
                    <div class="infoblock">
                        <p>{{ $thread->title . "     №" . $thread->num . "  " . $thread->created_at . " IP: " . $thread->poster_ip }}</p>
                        <a href="{{ route('threads.show', [$board->name_short, $thread->num]) }}">В тред</a>
                    </div>
                    <div class="stuff">
                        <div class="file"> </div>
                        <div class="text">{{ $thread->text }}</div>
                    </div>
                </div>
        @foreach ($thread->getLastPosts() as $post)

                <div class="post">
                    <div class="infoblock">
                        <p>{{ "Anonymous №" . $post->num . "  " . $post->updated_at . " IP: " . $post->poster_ip }}</p>
                    </div>
                    <div class="stuff">
                        <div class="file"> </div>
                        <div class="text">{{ $post->text }}</div>
                    </div>
                </div>
        @endforeach

            </div>
        @endforeach

        @if ($errors->any())
            
            <div class="thread">
                <ul>
            @foreach ($errors->all() as $error)
                    
                    <li>{{ $error }}</li>
            @endforeach
                
                </ul>
            </div>
        @endif
        
            <form method="POST" action="{{ route('threads.create', $board->name_short) }}">
                @csrf

                <input type="text" name="title" />
                <input type="text" name="text" />
                <input type="submit" />
            </form>
        </div>
            <div class="menu-block">
                <a href="#" class="menu-btn">
                    <span></span>
                </a>
                <nav class="menu">
                    <a href="#"><i class="fas fa-search"></i></a>
                    <a href="#"><i class="fas fa-sync-alt"></i></a>
                    <a href="#"><i class="far fa-heart"></i></a>
                </nav>
            </div>
        </div>
    </main>
    <footer></footer>
</div>
</body>
<script src="{{ asset('js/oneboard.js') }}"></script>
</html>