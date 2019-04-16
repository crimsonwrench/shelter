@extends('layouts.app')

@section('content')
    <div class="sidebar">
        <aside>
            <h1>Метрика</h1>
        </aside>
        <aside>
            <h1>Рандомный пост</h1>
        </aside>
    </div>
    <main>
@forelse($threads as $thread)
        <div class="thread">
            <div class="thread_content">
                <div class="info">
                    <p>{{ $thread->title . "     №" . $thread->num . "  " . $thread->created_at  }}</p>
                    <a href="{{ route('threads.show', [$board->name_short, $thread->num]) }}">[В тред]</a>
@if ($roles->contains('admin'))
                    <a href="{{ route('threads.delete', [$board->name_short, $thread->num]) }}">Удалить</a>
@endif
                </div>
                <div class="stuff">
                    <div class="pic">
@foreach($thread->files as $file)
                        <a href="{{ asset('res/' . $board->name_short . '/' . $thread->num . '/' . $file->name)}}">
                            <img src="{{ asset('res/' . $board->name_short . '/' . $thread->num . '/thumbnails/' . $file->name) }}"/>
                        </a>
@endforeach
                    </div>
                    <div class="text">{!! nl2br(e($thread->text)) !!}</div>
                </div>
            </div>
@foreach ($thread->activeChildren as $post)
            <div class="last_posts">
                <div class="info">
                    <p>{{ "Anonymous №" . $post->num . "  " . $post->created_at }}</p>
@if ($roles->contains('admin'))
                <a href="{{ route('posts.delete', [$board->name_short, $post->num]) }}">Удалить</a>
@endif
            </div>
            <div class="stuff">
                <div class="pic">
@foreach($post->files as $file)
                    <a href="{{ asset('res/' . $board->name_short . '/' . $thread->num . '/' . $file->name)}}">
                        <img src="{{ asset('res/' . $board->name_short . '/' . $thread->num . '/thumbnails/' . $file->name) }}"/>
                    </a>
@endforeach 
                    </div>
                <div class="text">{!! nl2br(e($post->text)) !!}</div>
            </div>
        </div>
@endforeach
        </div>
@empty
        <p>В данной доске нет ни одного треда!</p>
@endforelse
<form class="new_thread" method="POST" action="{{ route('threads.create', $board->name_short) }}" enctype="multipart/form-data">
    @csrf

    <p>Форма для постинга</p>
    <input type="text" name="title" class="new_info" placeholder="Введите имя">
    <textarea name="text" cols="40" rows="3" class="new_text" maxlength="15000" placeholder="Введите текст"></textarea>
    <div class="buttons">
        <label for="first_pic" class="custom_file_upload">
             Загрузить
        </label>
        <input id="first_pic" type="file" name="filename[]" multiple accept="image/png,image/jpeg/,image/jpg,image/gif">
        <label for="second_pic" class="custom_file_upload">
            Загрузить
        </label>
        <input id="second_pic" type="file" name="filename[]" multiple accept="image/png,image/jpeg/,image/jpg,image/gif">
        <label for="third_pic" class="custom_file_upload">
            Загрузить
        </label>
        <input id="third_pic" type="file" name="filename[]" multiple accept="image/png,image/jpeg/,image/jpg,image/gif">
        <input type="submit"/>
</form>

@if ($errors->any())
        <ul>
@foreach ($errors->all() as $error)            
            <li>{{ $error }}</li>
@endforeach            
        </ul>
@endif
@endsection