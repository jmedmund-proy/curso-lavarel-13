
    <h1>Editar Categoría: {{ $category->title }}</h1>

    @include('dashboard.fragment._errors')

    <form action="{{ route('category.update', $category) }}" method="post">
        @method('PUT')
        @include('dashboard.category._form')
    </form>
