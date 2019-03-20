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
    <div id="app">
            <boards></boards>
    </div>
<footer></footer>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>