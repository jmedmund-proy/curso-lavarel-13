@extends('dashboard.layout')

@section('content')

<h1>{{ $post->title }}</h1>
<p>{{ $post->descripcion }}</p>

<div>{{ $post->contenido }}</div>

@if ($post->image)
    <img src="/image/{{ $post->image }}" alt="{{ $post->image }}">
@endif

@endsection