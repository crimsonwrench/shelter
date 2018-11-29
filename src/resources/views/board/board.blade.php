@extends('layouts.app')

@section('content')
<div class="s">
            <div class="info">
                <div class="metrics">
                    <p>Здесь скоро появится статистика</p>
                </div>
                <div class="random">
                    <p>Здесь скоро появится рандомный тред</p>
                </div>
            </div>
            <div class="board">
@forelse($threads as $thread)

                <div class="thread">
                    <div class="d">
                        <div class="infoblock">
                            <p>{{ $thread->title . "     №" . $thread->num . "  " . $thread->created_at }}</p>
                            <a href="{{ route('threads.show', [$board->name_short, $thread->num]) }}">[В тред]</a>
                        </div>
                        <div class="stuff">
                            <div class="file"> </div>
                            <div class="text">{{ $thread->text }}</div>
                        </div>
                    </div>
@foreach ($thread->getLastPosts() as $post)
                <div class="post">
                    <div class="infoblock">
                        <p>{{ "Anonymous №" . $post->num . "  " . $post->created_at }}</p>
                    </div>
                    <div class="stuff">
                        <div class="file"> </div>
                        <div class="text">{{ $post->text }}</div>
                    </div>
                </div>
@endforeach
                </div>
@empty
                <p>В данной доске нет ни одного треда!</p>
@endforelse
                <h4>Форма для постинга</h4>
                <form method="POST" action="{{ route('threads.create', $board->name_short) }}">
                    @csrf

                    <input type="text" name="title" />
                    <input type="text" name="text" />
                    <input type="submit" />
                </form>
@if ($errors->any())
                <ul>
@foreach ($errors->all() as $error)            
                    <li>{{ $error }}</li>
@endforeach            
                </ul>
@endif
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
@endsection