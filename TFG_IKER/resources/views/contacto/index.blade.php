@extends('layouts.app')
@section('title','Contacto - JapanStyle')

@section('content')
<div class="container py-5" style="max-width:700px">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger">Inicio</a></li>
            <li class="breadcrumb-item active">Contacto</li>
        </ol>
    </nav>

    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Contacta con nosotros</h2>
        <p class="text-muted">¿Tienes alguna pregunta sobre nuestros itinerarios? Escríbenos y te responderemos en menos de 24 horas.</p>
    </div>

    <div class="row g-4">
        {{-- FORMULARIO --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius:12px">
                <div class="card-body p-4">

                    @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('contacto.send') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:.85rem">Tu email *</label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
                                   placeholder="tu@email.com" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:.85rem">Asunto *</label>
                            <input type="text" name="asunto"
                                   class="form-control @error('asunto') is-invalid @enderror"
                                   value="{{ old('asunto') }}"
                                   placeholder="Ej: Consulta sobre el itinerario de Kioto" required maxlength="150">
                            @error('asunto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="font-size:.85rem">Mensaje *</label>
                            <textarea name="mensaje"
                                      class="form-control @error('mensaje') is-invalid @enderror"
                                      rows="6" required minlength="10" maxlength="2000"
                                      placeholder="Escribe tu mensaje aquí...">{{ old('mensaje') }}</textarea>
                            @error('mensaje')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="text-muted small mt-1">Mínimo 10 caracteres, máximo 2000.</div>
                        </div>

                        <button type="submit" class="btn btn-danger fw-bold px-4">
                            <i class="fas fa-paper-plane me-2"></i>Enviar mensaje
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- INFO CONTACTO --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:12px;background:#f8f4ef">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4">Información de contacto</h6>

                    <div class="d-flex gap-3 mb-3">
                        <div style="width:36px;height:36px;border-radius:8px;background:#BC002D;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <i class="fas fa-envelope text-white" style="font-size:.85rem"></i>
                        </div>
                        <div>
                            <div style="font-size:.78rem;color:#888;font-weight:600;text-transform:uppercase;letter-spacing:.06em">Email</div>
                            <div style="font-size:.88rem">info@japanstyle.es</div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-3">
                        <div style="width:36px;height:36px;border-radius:8px;background:#BC002D;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <i class="fas fa-phone text-white" style="font-size:.85rem"></i>
                        </div>
                        <div>
                            <div style="font-size:.78rem;color:#888;font-weight:600;text-transform:uppercase;letter-spacing:.06em">Teléfono</div>
                            <div style="font-size:.88rem">+34 643 225 530</div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-4">
                        <div style="width:36px;height:36px;border-radius:8px;background:#BC002D;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <i class="fas fa-map-marker-alt text-white" style="font-size:.85rem"></i>
                        </div>
                        <div>
                            <div style="font-size:.78rem;color:#888;font-weight:600;text-transform:uppercase;letter-spacing:.06em">Dirección</div>
                            <div style="font-size:.88rem">Av. Francia 123<br>Vila-real, Castellon</div>
                        </div>
                    </div>

                    <div class="border-top pt-3">
                        <div style="font-size:.78rem;color:#888;font-weight:600;text-transform:uppercase;letter-spacing:.06em;margin-bottom:.5rem">Síguenos</div>
                        <div class="d-flex gap-2">
                            <a href="https://www.instagram.com/japanstyle" target="_blank"
                               style="width:34px;height:34px;border-radius:6px;background:#BC002D;display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://www.facebook.com/japanstyle" target="_blank"
                               style="width:34px;height:34px;border-radius:6px;background:#BC002D;display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.youtube.com/@japanstyle" target="_blank"
                               style="width:34px;height:34px;border-radius:6px;background:#BC002D;display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
