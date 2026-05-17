@extends('dashboard.layout')

@section('content')

@include('dashboard.fragment._errors')
<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Nuevo Post</h2>
    
    <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data" class="space-y-4">
        @method('PATCH')
        @include('dashboard.post._form', ['task' => 'edit'])
    </form>
</div>

</body>

@endsection