{{-- @include('dashboard.fragment._errors')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Post</title>
    
    {{-- ¡ESTA ES LA LÍNEA MÁGICA QUE TE FALTABA! --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Nuevo Post</h2>
    
    <form action="{{ route('post.update', $post->id) }}" method="post" class="space-y-4">  --}}
        {{--  --}}
        {{-- @method('PATCH') --}}
        @csrf {{-- ¡No olvides el token de seguridad de Laravel! --}}
        <!-- Titulo -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title ) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
        </div>

        <!-- Slug -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $post->slug ) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
        </div>

        <!-- Categoría y Posteado (En una fila) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                <select name="category_id" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                    <option value=""></option>
                    @foreach ($categories as $title => $id)
                        <option {{ old('category_id', $post->category_id ) == $id ? 'selected' : '' }} value="{{ $id }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Posteado</label>
                <select name="posted" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                    <option value="not" {{ old('category_id', $post->posted )  == 'not' ? 'selected' : '' }}>No</option>
                    <option value="yes" {{ old('category_id', $post->posted )  == 'yes' ? 'selected' : '' }}>Sí</option>
                </select>
            </div>
        </div>

        <!-- Contenido -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
            <textarea name="contenido" rows="4"
                class="w-full px-4 py-2 border border-gray-300 
                rounded-md focus:ring-2 focus:ring-blue-500 outline-none">{{ old('contenido', $post->contenido ) }}</textarea>
        </div>

        <!-- Descripción -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
            <textarea name="descripcion" rows="2"
                class="w-full px-4 py-2 border border-gray-300 rounded-md 
                focus:ring-2 focus:ring-blue-500 outline-none">{{ old('descripcion', $post->descripcion ) }}</textarea>
        </div>

        @if (isset($task) && $task == 'edit')
            <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Imagen destacada</label>
            <div class="flex items-center justify-center w-full">
                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-150">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <p class="text-xs text-gray-500">PNG, JPG o GIF (MAX. 2MB)</p>
                    </div>
                    <input type="file" name="image" class="hidden" accept="image/*" />
                </label>
            </div>
            </div>
        @endif

    

        <!-- Botón -->
        <div class="pt-4">
            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow-lg transform active:scale-95 transition duration-150">
                Actualizar Post
            </button>
        </div>
        {{--  --}}
{{-- 
    </form>
</div>
</body>
</html> --}}