@extends('admin.layouts.app_admin')

@section('content')
    <h1>Hello, {{ Auth::user()->name }}</h1>
@endsection