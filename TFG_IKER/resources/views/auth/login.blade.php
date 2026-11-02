@extends('layouts.guest')
@section('title','Iniciar sesion')
@section('card-title','Iniciar Sesion')

@section('content')
@if(session('status'))
<div class="alert alert-success small py-2">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}" required autofocus placeholder="tu@email.com">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
               required placeholder="Tu contraseña">
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label small" for="remember">Recordarme</label>
        </div>
        @if(Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="link-auth" style="font-size:.82rem">Olvide mi contraseña</a>
        @endif
    </div>
    <button type="submit" class="btn-rojo btn">
        <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión
    </button>
</form>
<div class="text-center mt-3" style="font-size:.85rem;color:#666">
    No tienes cuenta? <a href="{{ route('register') }}" class="link-auth">Registrate gratis</a>
</div>
@endsection
