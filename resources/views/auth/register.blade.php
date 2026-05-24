<html lang="es">
<head>

</head>
<body>
    <h1>Register</h1>
    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div style="margin-top: 1rem;">
            <label for="name">Name</label>
            <input type="name" name="name" id="name" value="{{ old('name') }}" required>
        </div>
        <div style="margin-top: 1rem;">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div style="margin-top: 1rem;">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div style="margin-top: 1rem;">
            <label for="password">Password Confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <div style="margin-top: 1rem;">
            <button type="submit">Register</button>
        </div>
    </form>
</body>
</html>