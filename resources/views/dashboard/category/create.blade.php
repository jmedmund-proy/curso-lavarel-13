
    <h1>Crear Categoría</h1>

    @include('dashboard.fragment._errors')

    <form action="{{ route('category.store') }}" method="post">
        @include('dashboard.category._form')
    </form>
