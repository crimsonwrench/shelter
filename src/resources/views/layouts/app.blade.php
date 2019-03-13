<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
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
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navigation">
    <ul>
        <li><a href="{{ route('boards.list') }}" rel="alternate">Главная</a></li>
        <li><a href="{{ route('boards.list') }}" rel="alternate">Каталог</a></li>
        <li><a href="{{ route('boards.list') }}" rel="alternate">Контакты</a></li>
    </ul>
</nav>
<header class="header">
@if (Route::is('boards.show') ?? Route::is('threads.show'))
        <h1>{{ $board->name }}</h1>
@endif
</header>
<div class="wrap"> 
    @yield('content') 
</div>
<footer></footer>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>