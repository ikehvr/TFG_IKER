@extends('layouts.app')
@section('title','Pago de reserva #' . $reserva->id . ' - JapanStyle')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-danger">Mis reservas</a></li>
            <li class="breadcrumb-item"><a href="{{ route('reservas.show', $reserva) }}" class="text-danger">Reserva #{{ $reserva->id }}</a></li>
            <li class="breadcrumb-item active">Pago</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm" style="border-radius:14px">
                <div class="card-body p-4 p-lg-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div style="width:52px;height:52px;border-radius:14px;background:rgba(188,0,45,.1);display:flex;align-items:center;justify-content:center">
                            <i class="fas fa-credit-card" style="color:#BC002D;font-size:1.3rem"></i>
                        </div>
                        <div>
                            <h1 class="fw-bold mb-1" style="font-size:1.8rem">Pasarela de pago segura</h1>
                            <div class="text-muted small">Completa el pago para confirmar la compra y generar tu recibo automaticamente.</div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('reservas.pagar', $reserva) }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold" style="font-size:.82rem">Titular de la tarjeta</label>
                                <input type="text" name="titular" class="form-control @error('titular') is-invalid @enderror"
                                       value="{{ old('titular', $reserva->user->name) }}" required>
                                @error('titular')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:.82rem">Email para la factura</label>
                                <input type="email" name="email_factura" class="form-control @error('email_factura') is-invalid @enderror"
                                       value="{{ old('email_factura', $reserva->user->email) }}" required>
                                @error('email_factura')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:.82rem">Metodo</label>
                                <input type="text" class="form-control" value="Tarjeta bancaria" disabled>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold" style="font-size:.82rem">Numero de tarjeta</label>
                                <input type="text" name="numero_tarjeta" class="form-control @error('numero_tarjeta') is-invalid @enderror"
                                       value="{{ old('numero_tarjeta') }}" maxlength="25" placeholder="4242 4242 4242 4242" required>
                                @error('numero_tarjeta')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:.82rem">Caducidad</label>
                                <input type="text" name="caducidad" class="form-control @error('caducidad') is-invalid @enderror"
                                       value="{{ old('caducidad') }}" maxlength="5" placeholder="MM/AA" required>
                                @error('caducidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:.82rem">CVC</label>
                                <input type="password" name="cvc" class="form-control @error('cvc') is-invalid @enderror"
                                       value="{{ old('cvc') }}" maxlength="4" placeholder="123" required>
                                @error('cvc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="rounded-3 p-3 mt-4" style="background:#f8f4ef">
                            <div class="form-check">
                                <input class="form-check-input @error('acepta') is-invalid @enderror" type="checkbox" value="1" id="acepta" name="acepta" {{ old('acepta') ? 'checked' : '' }}>
                                <label class="form-check-label small" for="acepta">
                                    Acepto el procesamiento seguro del pago y la generacion del recibo de compra.
                                </label>
                                @error('acepta')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger mt-4 px-4 py-2 fw-bold">
                            <i class="fas fa-lock me-2"></i>Pagar {{ number_format($reserva->total, 0, ',', '.') }} EUR
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm sticky-top" style="top:90px;border-radius:14px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Resumen de la compra</h5>
                    <div class="d-flex gap-3 mb-4">
                        <img src="{{ asset($reserva->itinerario->imagen_principal) }}" alt="{{ $reserva->itinerario->titulo }}"
                             style="width:110px;height:78px;object-fit:cover;border-radius:10px">
                        <div>
                            <div class="fw-bold">{{ $reserva->itinerario->titulo }}</div>
                            <div class="text-muted small">{{ $reserva->fecha_salida->format('d/m/Y') }} | {{ $reserva->n_viajeros }} viajeros</div>
                            <div class="text-muted small">{{ $reserva->itinerario->destino_principal }}</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">Precio por persona</span>
                        <span>{{ number_format($reserva->precio_unitario, 0, ',', '.') }} EUR</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">Viajeros</span>
                        <span>{{ $reserva->n_viajeros }}</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold pt-3 border-top">
                        <span>Total a pagar</span>
                        <span style="color:#BC002D;font-size:1.2rem">{{ number_format($reserva->total, 0, ',', '.') }} EUR</span>
                    </div>
                    <div class="rounded-3 p-3 mt-4" style="background:rgba(25,135,84,.08)">
                        <div class="fw-semibold small mb-1"><i class="fas fa-shield-alt me-2 text-success"></i>Compra protegida</div>
                        <div class="text-muted small">Tras el pago se confirma la reserva y se habilita el recibo con referencia de compra.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
