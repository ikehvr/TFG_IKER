@extends('layouts.guest')
@section('title','Crear cuenta')
@section('card-title','Crear Cuenta')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nombre completo</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}" required autofocus placeholder="Tu nombre">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}" required placeholder="tu@email.com">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
               required placeholder="Minimo 8 caracteres" oninput="checkStrength(this.value)">
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        <div class="mt-1">
            <div style="height:3px;background:#eee;border-radius:2px">
                <div id="sbar" style="height:100%;width:0;transition:width .3s,background .3s;border-radius:2px"></div>
            </div>
            <small id="stxt" class="text-muted"></small>
        </div>
    </div>
    <div class="mb-4">
        <label class="form-label">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" class="form-control" required placeholder="Repite la contraseña">
    </div>
    <button type="submit" class="btn-rojo btn">
        <i class="fas fa-user-plus me-2"></i>Crear mi cuenta
    </button>
</form>
<div class="text-center mt-3" style="font-size:.85rem;color:#666">
    Ya tienes cuenta? <a href="{{ route('login') }}" class="link-auth">Inicia sesión</a>
</div>

@push('scripts')
<script>
function checkStrength(p) {
    let s = 0;
    if(p.length>=8)s++;if(/[A-Z]/.test(p))s++;if(/[0-9]/.test(p))s++;if(/[^A-Za-z0-9]/.test(p))s++;
    const l=[{w:'0%',b:'transparent',t:''},{w:'25%',b:'#dc3545',t:'Muy debil'},{w:'50%',b:'#fd7e14',t:'Debil'},{w:'75%',b:'#ffc107',t:'Aceptable'},{w:'100%',b:'#198754',t:'Fuerte'}];
    document.getElementById('sbar').style.width=l[s].w;
    document.getElementById('sbar').style.background=l[s].b;
    document.getElementById('stxt').textContent=l[s].t;
}
</script>
@endpush
@endsection
