@extends('blog.layout')

@section('content')

    {{-- <x-blog.post.index :posts="$posts" /> --}}
    <x-blog.post.index :posts="$posts" title="Listaza">
        POST LIST
        @slot('titulo')
            HOLA
        @endslot
    </x-blog.post.index>

@endsection