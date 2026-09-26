@extends('auth.layout')

@section('content')

    <div class="max-w-sm w-full bg-white border border-gray-100 rounded-2xl shadow-xl p-8 space-y-6">

        <!-- Encabezado -->
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Ingresa tu clave</h1>
            <p class="text-sm text-gray-500 mt-1">
                Digita el código de 6 dígitos que enviamos a tu correo
            </p>
        </div>

        <!-- Errores y Alertas de sesión -->
        @include('dashboard.fragment._errors')

        @if (session('status'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-100" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulario para validar el código -->
        <form method="POST" action="{{ route('login.token.verify') }}" class="space-y-5">
            @csrf
            
            <div class="space-y-1">
                <label for="token" class="block text-sm font-medium text-gray-700">Clave</label>
                <input type="text" 
                       name="token" 
                       id="token" 
                       maxlength="6"
                       required 
                       autofocus 
                       placeholder="000000"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-center text-lg font-mono tracking-widest text-gray-900 placeholder-gray-300 focus:outline-hidden focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition duration-200">
            </div>

            <div class="pt-2">
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-xs text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-hidden focus:ring-4 focus:ring-blue-100 transition duration-200 cursor-pointer">
                    Validar e iniciar sesión
                </button>
            </div>
        </form>

        <div class="border-t border-gray-100 my-2"></div>

        <!-- Enlaces de acción separables -->
        <div class="flex flex-col space-y-3 text-center pt-1">
            
            <!-- Opción 1: Reenviar código -->
            <form method="POST" action="{{ route('auth.login-token-resend') }}">
                @csrf
                <!-- Opcional: si guardas el email en sesión puedes pasarlo oculto -->
                <button type="submit" 
                        class="text-sm font-medium text-blue-600 hover:text-blue-700 transition underline decoration-2 decoration-blue-100 hover:decoration-blue-600 bg-transparent border-0 cursor-pointer">
                    ¿No recibiste el código? Reenviar
                </button>
            </form>

            <!-- Opción 2: Cambiar de correo -->
            <a href="{{ route('auth.login-token-email') }}" 
               class="text-xs text-gray-500 hover:text-gray-700 transition">
                ← Cambiar dirección de correo
            </a>

        </div>

    </div>

@endsection