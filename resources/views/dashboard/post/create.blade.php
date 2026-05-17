{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Post</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head> --}}
@extends('dashboard.layout')

@section('content')

<body class="bg-gray-100 min-h-screen">

    @include('dashboard.fragment._errors')

    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Crear Nuevo Post</h2>
    
    <form action="{{ route('post.store') }}" method="post" class="space-y-4">
        @include('dashboard.post._form')
    </form>
</div>

</body>

@endsection