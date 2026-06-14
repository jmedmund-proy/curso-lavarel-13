@extends('auth.layout')

@section('content')
<div class="max-w-md w-full bg-white border border-gray-100 rounded-2xl shadow-xl p-8 space-y-6">
    
    <div class="text-center">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Registro</h1>
        <p class="text-sm text-gray-500 mt-1">Crea tu cuenta para empezar a trabajar</p>
    </div>

    @include('dashboard.fragment._errors')

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        
        <div class="space-y-1">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   placeholder="Tu nombre"
                   class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition duration-200">
        </div>

        <div class="space-y-1">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" 
                   value="{{ old('email') }}" 
                   required 
                   placeholder="tu@correo.com"
                   class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition duration-200">
        </div>

        <div class="space-y-1">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" 
                   required 
                   placeholder="••••••••"
                   class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition duration-200">
        </div>

        <div class="space-y-1">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Password Confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" 
                   required 
                   placeholder="••••••••"
                   class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition duration-200">
        </div>

        <div class="pt-3">
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl shadow-xs text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-hidden focus:ring-4 focus:ring-blue-100 transition duration-200 cursor-pointer">
                Register
            </button>
        </div>
    </form>

    <div class="border-t border-gray-100 my-1"></div>

    <div class="text-center pt-1">
        <p class="text-sm text-gray-600">
            ¿Ya tienes una cuenta? 
            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-700 transition underline decoration-2 decoration-blue-100 hover:decoration-blue-600">
                Inicia sesión aquí
            </a>
        </p>
    </div>

</div>
@endsection