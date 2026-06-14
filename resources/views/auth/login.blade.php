@extends('auth.layout')

@section('content')
<div class="max-w-sm w-full bg-white border border-gray-100 rounded-2xl shadow-xl p-8 space-y-6">

        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Login</h1>
            <p class="text-sm text-gray-500 mt-1">Ingresa tus credenciales para acceder</p>
        </div>

        @include('dashboard.fragment._errors')

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            
            <div class="space-y-1">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       placeholder="tu@correo.com"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition duration-200">
            </div>

            <div class="space-y-1">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" 
                       required 
                       placeholder="••••••••"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition duration-200">
            </div>

            <div class="flex items-center pt-1">
                <input type="checkbox" name="remember" id="remember_me" 
                       class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                <label for="remember_me" class="ml-2 block text-sm text-gray-600 select-none cursor-pointer">
                    Recuérdame
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-xs text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-hidden focus:ring-4 focus:ring-blue-100 transition duration-200 cursor-pointer">
                    Login
                </button>
            </div>
        </form>

        <div class="border-t border-gray-100 my-2"></div>

        <div class="text-center pt-2">
            <p class="text-sm text-gray-600">
                ¿Eres nuevo por aquí? 
                <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-700 transition underline decoration-2 decoration-blue-100 hover:decoration-blue-600">
                    Regístrate aquí
                </a>
            </p>
        </div>

</div>
@endsection