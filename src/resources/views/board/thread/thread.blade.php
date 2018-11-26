@extends('layouts.app')

@section('content')
<div class="s">
            <div class="info">
                <div class="metrics"></div>
                <div class="random"></div>
            </div>
                
            <div class="board">
                <div class="thread">
                    <div class="d">
                        <div class="infoblock">
                            <p>{{ $thread->title . "     №" . $thread->num . "  " . $thread->created_at . " IP: " . $thread->user->ip}}</p>
                        </div>
                        <div class="stuff">
                            <div class="file"></div>
                            <div class="text">{{ $thread->text }}</div>
                        </div>
                    </div>
@forelse ($posts as $post)
            <div class="post">
                <div class="infoblock">
                    <p>{{ "Anonymous №" . $post->num . "  " . $post->updated_at . " IP: " . $post->user->ip }}</p>
                </div>
                <div class="stuff">
                    <div class="file"> </div>
                    <div class="text">{{ $post->text }}</div>
                </div>
            </div>
@empty
                    <p>В данном треде нет ни одного поста!</p>
@endforelse
                </div>
@if ($errors->any())          
        <ul>
@foreach ($errors->all() as $error)    
            <li>{{ $error }}</li>
@endforeach      
        </ul>
@endif
                <form method="POST" action="{{ route('posts.create', [$board->name_short, $thread->num]) }}">
                    @csrf

                    <input type="text" name="text" />
                    <input type="submit" />
                </form>
            </div>
        </div>
@endsection