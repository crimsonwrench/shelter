<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <nav>
        <a href="{{ route('boards.list') }}" rel="alternate">Главная</a>
        <a href="{{ route('boards.list') }}" rel="alternate">Каталог</a>
        <a href="{{ route('boards.list') }}" rel="alternate">Контакты</a>
    </nav>
    <header></header>

    <main> 
        @yield('content')

    </main>

    <footer></footer>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</html>
