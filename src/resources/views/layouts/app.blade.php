<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
@if (Route::is('threads.show'))
        {{ "/" . $board->name_short . "/ - " . $thread->title }}
@elseif (Route::is('boards.show'))
        {{ "/" . $board->name_short . "/ - " . $board->name }}
@else
        {{ config('app.name') }}
@endif
    </title>
    <link href="{{ asset('css/oneboard.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <nav>
        <a href="" rel="alternate">Главная</a>
        <a href="" rel="alternate">Каталог</a>
        <a href="" rel="alternate">Контакты</a>
        <a href="" rel="alternate">Вход</a>
    </nav>
    <header>
@if (isset($board))
        <h1>{{ $board->name }}</h1>
@endif
    </header>

    <main> 
        @yield('content')

@if ($errors->any())
                <ul>
@foreach ($errors->all() as $error)            
                    <li>{{ $error }}</li>
@endforeach            
                </ul>
@endif
    </main>

    <footer></footer>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/oneboard.js') }}"></script>
</html>