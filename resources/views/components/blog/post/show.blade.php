<div class="blog-grid">
   {{-- {{ changeTitle(); }} --}}
    <div class="blog-card">
        <div>
            <h3 class="blog-card-title">
                {{ $post->title }}
            </h3>
            <p class="blog-card-desc">
                {{ $post->created_at }}
            </p>
            <p class="blog-card-desc">
                {{ $post->descripcion }}
            </p>
        </div>

        <div class="post">
            {{ $post->contenido }}
        </div>
    </div>
</div>