@extends('layouts.guest')
@section('title','Recuperar contrasena')
@section('card-title','Recuperar Contrasena')

@section('content')
<p class="text-muted small mb-3">Introduce tu email y te enviaremos un enlace para restablecer tu contraseña.</p>

@if(session('status'))
<div class="alert alert-success small py-2">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}" required autofocus placeholder="tu@email.com">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn-rojo btn">
        <i class="fas fa-paper-plane me-2"></i>Enviar enlace
    </button>
</form>
<div class="text-center mt-3">
    <a href="{{ route('login') }}" class="link-auth" style="font-size:.85rem">Volver al login</a>
</div>
@endsection
