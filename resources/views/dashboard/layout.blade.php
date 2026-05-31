<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
</head>
<body>

    <nav class="bg-white border-b border-gray-100 shadow-xs sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                <div class="flex items-center gap-8">
                    <div class="flex shrink-0 items-center font-bold text-xl text-blue-600 tracking-tight">
                        Dashboard
                    </div>

                    <div class="hidden md:flex items-center gap-4">
                        <a href="{{ route('post.index') }}" 
                           class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('post.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                            Posts
                        </a>
                        <a href="{{ route('category.index') }}" 
                           class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('category.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                            Categorías
                        </a>
                    </div>
                </div>

                <div class="flex items-center">
                    <details class="relative inline-block text-left group">
                        <summary class="flex items-center gap-2 list-none cursor-pointer px-3 py-2 rounded-xl hover:bg-gray-50 transition select-none">
                            <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm uppercase">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-gray-700 hidden sm:inline">
                                {{ Auth::user()->name ?? 'Usuario' }}
                            </span>
                            <svg class="w-4 h-4 text-gray-400 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </summary>

                        <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-lg py-1 z-50 origin-top-right focus:outline-hidden">
                            <div class="px-4 py-2 text-xs text-gray-400 border-b border-gray-50">
                                Gestionar Cuenta
                            </div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium transition cursor-pointer">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </details>
                </div>

            </div>
        </div>
    </nav>

{{-- Mensaje flash basico
    @if (session('status'))
        {{ session('status') }}
    @endif 
--}}

    @if (session('status'))
        <div class="max-w-6xl mx-auto mb-6 px-2">
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-start gap-3 shadow-sm">
                <div class="text-green-600 shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                
                <div class="flex-1">
                    <p class="text-sm font-semibold text-green-800">
                        ¡Logrado!
                    </p>
                    <p class="text-xs text-green-700 mt-0.5">
                        {{ session('status') }} </p>
                </div>
            </div>
        </div>
    @endif

    {{-- {{ session('misesion') }} --}}
    
    <div class="container">
        @yield('content')
    </div>

</body>
</html>