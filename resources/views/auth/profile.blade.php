@extends('auth.layout')

@section('content')

<div class="max-w-md w-full bg-white border border-gray-100 rounded-2xl shadow-xl p-8 space-y-6">
    
    <h2 class="text-2xl font-bold text-gray-900 text-center tracking-tight">
        Editar Perfil
    </h2>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PATCH')

        <div class="flex justify-center">
            @if($profile->avatar)
                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="w-28 h-28 rounded-full object-cover ring-4 ring-blue-50 shadow-md">
            @else
                <div class="w-28 h-28 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-600 flex items-center justify-center text-white text-3xl font-semibold shadow-md">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endif
        </div>

        <div class="space-y-1">
            <label for="avatar" class="block text-sm font-medium text-gray-700">
                Foto de Perfil
            </label>
            <input type="file" name="avatar" id="avatar" 
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition cursor-pointer">
            @error('avatar') 
                <span class="text-xs font-medium text-red-600 mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <div class="space-y-1">
            <label for="address" class="block text-sm font-medium text-gray-700">
                Dirección
            </label>
            <input type="text" name="address" id="address" 
                   value="{{ old('address', $profile->address) }}" 
                   placeholder="Tu dirección completa"
                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition duration-200">
            @error('address') 
                <span class="text-xs font-medium text-red-600 mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <div class="flex items-center gap-3 pt-2">
            <a href="{{ route('post.index') }}" 
               class="w-1/2 flex justify-center py-3 px-4 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-hidden focus:ring-4 focus:ring-blue-50 transition duration-200 text-center cursor-pointer">
                Regresar
            </a>

            <button type="submit" 
                    class="w-1/2 flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-xs text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-hidden focus:ring-4 focus:ring-blue-100 transition duration-200 cursor-pointer">
                Guardar
            </button>
        </div>
    </form>
</div>

@endsection