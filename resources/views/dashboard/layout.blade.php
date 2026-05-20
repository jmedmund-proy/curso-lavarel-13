<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

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

    {{ session('misesion') }}

    @yield('content')

</body>
</html>