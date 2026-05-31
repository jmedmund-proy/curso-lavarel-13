@extends('auth.layout')

@section('content')
    <div class="auth-screen">
    <div class="auth-card">
        <h1 class="auth-title">Register</h1>

        {{-- @include('dashboard.fragment._errors')
        @if ($errors->any())
            <div class="auth-error-container">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf
            <div>
                <label for="name" class="auth-label">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="auth-input">
            </div>
            <div>
                <label for="email" class="auth-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="auth-input">
            </div>
            <div>
                <label for="password" class="auth-label">Password</label>
                <input type="password" name="password" id="password" required class="auth-input">
            </div>
            <div>
                <label for="password_confirmation" class="auth-label">Password Confirmation</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="auth-input">
            </div>
            <div class="auth-button-container">
                <button type="submit" class="auth-button">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection