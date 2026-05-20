@extends('dashboard.layout')

@section('content')
<div class="max-w-4xl mx-auto p-6 mt-10">
    
    <div class="mb-6">
        <a href="{{ route('post.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition gap-1">
            ← Volver al listado
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden p-8 md:p-12">
        
        @if($post->category)
            <span class="inline-block bg-purple-50 text-purple-700 text-xs px-3 py-1.5 rounded-full font-semibold uppercase tracking-wider mb-4">
                {{ $post->category->title }}
            </span>
        @endif

        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-950 tracking-tight leading-tight mb-4">
            {{ $post->title }}
        </h1>

        <p class="text-lg text-gray-600 leading-relaxed font-light border-l-4 border-blue-500 pl-4 my-6">
            {{ $post->descripcion }}
        </p>

        @if ($post->image)
            <div class="my-8 rounded-xl overflow-hidden shadow-md border border-gray-100 bg-gray-50">
                <img src="/image/{{ $post->image }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-auto max-h-[450px] object-cover object-center transform hover:scale-[1.01] transition duration-300">
            </div>
        @endif

        <hr class="border-gray-100 my-8">

        <div class="prose max-w-none text-gray-800 leading-bold space-y-4">
            <p class="text-base md:text-lg">
                {{ $post->contenido }}
            </p>
        </div>

    </div>
</div>
@endsection