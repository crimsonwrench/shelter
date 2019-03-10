@extends('layouts.app')

@section('content')
<div class="list">
    <ul>
        @foreach ($boards as $board)
            <li><a href="{{ "/". $board->name_short }}">{{ "/" . $board->name_short . "/ - " . $board->name }}</a></li>
        @endforeach
    </ul>
</div>    
@endsection