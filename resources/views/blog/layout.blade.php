<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    @vite(['resources/css/blog.css'])
</head>
<body>

    <div class="min-h-screen bg-gray-100 dark:bg-orange-900">
        {{-- Page Heading --}}
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800" shadow>
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        {{-- Page Content --}}
        <main>
            <div class="container mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>