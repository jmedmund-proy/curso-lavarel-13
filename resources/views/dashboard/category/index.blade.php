@extends('dashboard.layout')

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="max-w-6xl mx-auto mt-10 p-4">
    <div class="overflow-hidden bg-white shadow-md rounded-xl border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-700">Título</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-700">Slug</th>
                    {{-- <th class="px-6 py-4 text-sm font-semibold text-gray-700 text-center">Acciones</th> --}}
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($categories as $c)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $c->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 font-mono">{{ $c->slug }}</td>
                        {{-- <td class="px-6 py-4 text-sm">
                            <div class="flex items-center justify-center gap-2">
                                <a class="px-3 py-1.5 bg-blue-600 text-white text-xs font-bold rounded hover:bg-blue-700 transition" 
                                   href="{{ route('category.edit', $c) }}">Editar</a>
                                
                                <a class="px-3 py-1.5 bg-gray-600 text-white text-xs font-bold rounded hover:bg-gray-700 transition" 
                                   href="{{ route('category.show', $c) }}">Ver</a>

                                <form action="{{ route('category.destroy', $c) }}" method="post" class="inline">
                                    @method('DELETE')
                                    @csrf
                                    <button class="px-3 py-1.5 bg-red-600 text-white text-xs font-bold rounded hover:bg-red-700 transition cursor-pointer" 
                                            type="submit" onclick="return confirm('¿Eliminar?')">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>

@endsection