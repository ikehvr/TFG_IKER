@extends('layouts.app')
@section('title','Mi perfil - JapanStyle')

@section('content')
<div class="container py-5" style="max-width:700px">
    <h3 class="fw-bold mb-4">Mi perfil</h3>

    @if(session('status') === 'profile-updated')
    <div class="alert alert-success">Perfil actualizado correctamente.</div>
    @endif

    {{-- DATOS --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius:12px">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">Informaci&oacute;n personal</h5>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf @method('patch')
                <div class="d-flex flex-column flex-md-row align-items-md-center gap-4 mb-4">
                    <div>
                        @if($user->profilePhotoUrl())
                            <img src="{{ $user->profilePhotoUrl() }}" alt="Foto de perfil"
                                 style="width:88px;height:88px;object-fit:cover;border-radius:50%;border:4px solid rgba(188,0,45,.12)">
                        @else
                            <div style="width:88px;height:88px;border-radius:50%;background:#BC002D;color:#fff;display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:700">
                                {{ strtoupper(substr($user->name,0,1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <label class="form-label fw-semibold" style="font-size:.82rem">Foto de perfil</label>
                        <input type="file" name="profile_photo" class="form-control @error('profile_photo') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp">
                        <div class="text-muted small mt-1">Formatos permitidos: JPG, PNG o WEBP. M&aacute;ximo 2 MB.</div>
                        @error('profile_photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.82rem">Nombre</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.82rem">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-danger">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>

    {{-- CONTRASEÑA --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius:12px">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">Cambiar contrase&ntilde;a</h5>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf @method('put')
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" style="font-size:.82rem">Contrase&ntilde;a actual</label>
                        <input type="password" name="current_password" class="form-control @error('current_password','updatePassword') is-invalid @enderror">
                        @error('current_password','updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" style="font-size:.82rem">Nueva contrase&ntilde;a</label>
                        <input type="password" name="password" class="form-control @error('password','updatePassword') is-invalid @enderror">
                        @error('password','updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" style="font-size:.82rem">Confirmar nueva</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-danger">Actualizar contrase&ntilde;a</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ELIMINAR CUENTA --}}
    <div class="card border-0 shadow-sm" style="border-radius:12px;border:1px solid rgba(188,0,45,.15)!important">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-2 text-danger">Eliminar cuenta</h5>
            <p class="text-muted small mb-3">Una vez eliminada, todos tus datos ser&aacute;n borrados permanentemente.</p>
            <form method="POST" action="{{ route('profile.destroy') }}"
                  onsubmit="return confirm('&iquest;Seguro que quieres eliminar tu cuenta?')">
                @csrf @method('delete')
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:.82rem">Confirma tu contrase&ntilde;a</label>
                    <input type="password" name="password" class="form-control @error('password','userDeletion') is-invalid @enderror"
                           style="max-width:280px" placeholder="Tu contrase&ntilde;a actual">
                    @error('password','userDeletion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-outline-danger">Eliminar mi cuenta</button>
            </form>
        </div>
    </div>
</div>
@endsection
