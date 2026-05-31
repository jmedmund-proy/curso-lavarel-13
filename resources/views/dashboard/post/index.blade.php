@extends('dashboard.layout')

@section('content')

<div class="max-w-6xl mx-auto p-6 mt-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Listado de Posts</h2>
        <a href="{{ route('post.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-150 text-sm">
            + Crear Nuevo Post
        </a>
    </div>

    <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="">
                        <th class="px-6 py-4">Id</th>
                        <th class="px-6 py-4">Title</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Posted</th>
                        <th class="px-6 py-4 text-right">Opciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @foreach ($posts as $p)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 font-mono text-gray-400 text-xs">
                                #{{ $p->id }}
                            </td>
                            
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $p->title }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="bg-purple-100 text-purple-800 text-xs px-2.5 py-1 rounded-full font-medium">
                                    {{ $p->category->title }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4">
                                @if($p->posted === 'yes')
                                    <span class="inline-flex items-center gap-1.5 bg-green-100 text-green-800 text-xs px-2.5 py-1 rounded-full font-medium">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Sí
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-amber-100 text-amber-800 text-xs px-2.5 py-1 rounded-full font-medium">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> No
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-3">
                                    <a href="{{ route('post.show', $p) }}" 
                                       class="text-blue-600 hover:text-blue-800 font-medium transition">
                                        Mostrar
                                    </a>
                                    
                                    <a href="{{ route('post.edit', $p) }}" target="_blank" 
                                       class="text-gray-600 hover:text-gray-900 font-medium transition">
                                        Editar
                                    </a>
                                    
                                    <form action="{{ route('post.destroy', $p) }}" method="post" class="inline">
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
        {{ $posts->links() }}
    </div>
</div>

@endsection