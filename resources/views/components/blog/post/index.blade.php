@props(['title' => 'Default title', 'posts'])
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1>{{ $slot }}</h1>
    @isset($titulo)
        <h1>{{ $titulo }}</h1>
    @endisset

    {{ $title }}

    {{ $attributes }}
    
    <div class="blog-grid">
    @foreach ($posts as $p)
    
        <div class="blog-card">
                <div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 block mb-1 font-medium">
                        {{ $p->created_at->format('d/m/Y') }}
                    </span>

                    <h3 class="blog-card-title">
                        {{ $p->title }}
                    </h3>
                    
                    <p class="blog-card-desc">
                        {{ $p->descripcion }}
                    </p>
                </div>

                <div class="mt-auto">
                    <a href="{{ route('blog.show', $p) }}" class="blog-btn-primary">
                        Leer más
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
        </div>
    @endforeach
    </div>

    <div class="mt-6 px-2">
        {{ $posts->links() }}
    </div>
</div>