@extends('dashboard.layout')

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="max-w-6xl mx-auto p-6 mt-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Listado de Categorias</h2>
        <a href="{{ route('category.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-150 text-sm">
            + Crear Nueva Categoria
        </a>
    </div>

    <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="">
                        <th class="px-6 py-4">Id</th>
                        <th class="px-6 py-4">Title</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4 text-right">Opciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @foreach ($categories as $c)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 font-mono text-gray-400 text-xs">
                                #{{ $c->id }}
                            </td>
                            
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $c->title }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="bg-purple-100 text-purple-800 text-xs px-2.5 py-1 rounded-full font-medium">
                                    {{ $c->slug }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-3">
                                    <a href="{{ route('category.show', $c) }}" 
                                       class="text-blue-600 hover:text-blue-800 font-medium transition">
                                        Mostrar
                                    </a>
                                    
                                    <a href="{{ route('category.edit', $c) }}" target="_blank" 
                                       class="text-gray-600 hover:text-gray-900 font-medium transition">
                                        Editar
                                    </a>
                                    
                                    <form action="{{ route('category.destroy', $c) }}" method="post" class="inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" 
                                                onclick="return confirm('¿Seguro que quieres borrar este post?')"
                                                class="text-red-600 hover:text-red-800 font-medium transition bg-transparent border-none cursor-pointer p-0">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 px-2">
        {{ $categories->links() }}
    </div>
</div>

@endsection