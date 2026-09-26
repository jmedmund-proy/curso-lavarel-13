@extends('auth.layout')

@section('content')

    <div class="max-w-sm w-full bg-white border border-gray-100 rounded-2xl shadow-xl p-8 space-y-6">

        <!-- Encabezado -->
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Inicia sesión con clave</h1>
            <p class="text-sm text-gray-500 mt-1">
                Ingresa tu correo para recibir una clave de verificación de 6 dígitos
            </p>
        </div>

        <!-- Errores y Alertas de sesión -->
        @include('dashboard.fragment._errors')

        @if (session('status'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-100" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulario para solicitar el token -->
        <form method="POST" action="{{ route('auth.email-sendToken') }}" class="space-y-5">
            @csrf
            
            <div class="space-y-1">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus 
                    placeholder="tu@correo.com"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition duration-200">
            </div>

            <div class="pt-2">
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-xs text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-hidden focus:ring-4 focus:ring-blue-100 transition duration-200 cursor-pointer">
                    Enviar código
                </button>
            </div>
        </form>

        <div class="border-t border-gray-100 my-2"></div>

        <!-- Enlace para regresar -->
        <div class="text-center pt-2">
            <a href="{{ route('login') }}" 
            class="text-sm font-medium text-blue-600 hover:text-blue-700 transition underline decoration-2 decoration-blue-100 hover:decoration-blue-600">
                Regresar a inicio de sesión
            </a>
        </div>

    </div>

@endsection
