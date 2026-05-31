@extends('auth.layout')

@section('content')
    <div class="auth-screen">
    <div class="auth-card">
        <h1 class="auth-title">Login</h1>

        @include('dashboard.fragment._errors')

        {{-- @if ($errors->any())
            <div class="auth-error-container">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <div>
                <label for="email" class="auth-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="auth-input">
            </div>
            <div>
                <label for="password" class="auth-label">Password</label>
                <input type="password" name="password" id="password" required class="auth-input">
            </div>
            <div class="auth-button-container">
                <button type="submit" class="auth-button">Login</button>
            </div>
        </form>
    </div>
</div>
    
@endsection
