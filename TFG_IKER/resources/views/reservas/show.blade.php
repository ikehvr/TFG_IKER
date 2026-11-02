@extends('layouts.app')
@section('title','Reserva #' . $reserva->id . ' - JapanStyle')

@section('content')
<div class="container py-5" style="max-width:800px">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-danger">Mis reservas</a></li>
            <li class="breadcrumb-item active">Reserva #{{ $reserva->id }}</li>
        </ol>
    </nav>

    @php
    $banners = [
        'confirmada' => ['class'=>'success','icon'=>'fas fa-check-circle','msg'=>'Reserva confirmada. Prepara tu maleta!'],
        'pendiente'  => ['class'=>'warning','icon'=>'fas fa-clock','msg'=>'Pago pendiente. Completa el pago para confirmar.'],
        'cancelada'  => ['class'=>'danger', 'icon'=>'fas fa-times-circle','msg'=>'Esta reserva fue cancelada.'],
        'completada' => ['class'=>'info',   'icon'=>'fas fa-flag-checkered','msg'=>'Viaje completado. Esperamos que lo hayas disfrutado!'],
    ];
    $b = $banners[$reserva->estado] ?? $banners['pendiente'];
    @endphp

    <div class="alert alert-{{ $b['class'] }} d-flex align-items-center gap-3 mb-4">
        <i class="{{ $b['icon'] }} fa-2x"></i>
        <div>
            <div class="fw-bold">{{ $b['msg'] }}</div>
            <div style="font-size:.82rem">Referencia: <strong>#{{ $reserva->id }}</strong> | Creada el {{ $reserva->created_at->format('d/m/Y') }}</div>
        </div>
    </div>

    {{-- ITINERARIO --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius:10px">
        <div class="card-body p-4">
            <h6 style="font-size:.72rem;text-transform:uppercase;letter-spacing:.1em;color:#aaa;margin-bottom:1rem">Itinerario reservado</h6>
            <div class="d-flex gap-3">
                <img src="{{ asset($reserva->itinerario->imagen_principal) }}"
                     style="width:90px;height:65px;object-fit:cover;border-radius:8px;flex-shrink:0" alt="">
                <div>
                    <div style="font-weight:700;font-size:1rem">{{ $reserva->itinerario->titulo }}</div>
                    <div style="font-size:.82rem;color:#888;margin-top:3px">
                        {{ $reserva->itinerario->duracion_dias }} dias | {{ $reserva->itinerario->destino_principal }} | {{ ucfirst($reserva->itinerario->categoria) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DETALLES --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius:10px">
        <div class="card-body p-4">
            <h6 style="font-size:.72rem;text-transform:uppercase;letter-spacing:.1em;color:#aaa;margin-bottom:1rem">Detalles</h6>
            <div class="row g-3">
                <div class="col-4">
                    <div style="font-size:.72rem;color:#aaa">Fecha salida</div>
                    <div style="font-weight:600">{{ $reserva->fecha_salida->format('d/m/Y') }}</div>
                </div>
                <div class="col-4">
                    <div style="font-size:.72rem;color:#aaa">Viajeros</div>
                    <div style="font-weight:600">{{ $reserva->n_viajeros }}</div>
                </div>
                <div class="col-4">
                    <div style="font-size:.72rem;color:#aaa">Titular</div>
                    <div style="font-weight:600">{{ $reserva->user->name }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- PRECIO --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius:10px">
        <div class="card-body p-4">
            <h6 style="font-size:.72rem;text-transform:uppercase;letter-spacing:.1em;color:#aaa;margin-bottom:1rem">Desglose del precio</h6>
            <div class="d-flex justify-content-between mb-2" style="font-size:.88rem">
                <span class="text-muted">Precio por persona</span>
                <span>{{ number_format($reserva->precio_unitario,0,',','.') }} EUR</span>
            </div>
            <div class="d-flex justify-content-between mb-2" style="font-size:.88rem">
                <span class="text-muted">Numero de viajeros</span>
                <span>x {{ $reserva->n_viajeros }}</span>
            </div>
            <div class="d-flex justify-content-between fw-bold pt-2 border-top">
                <span>Total</span>
                <span style="font-size:1.2rem;color:#BC002D">{{ number_format($reserva->total,0,',','.') }} EUR</span>
            </div>
            @if($reserva->paid_at)
            <div class="d-flex justify-content-between mt-3 pt-3 border-top" style="font-size:.88rem">
                <span class="text-muted">Pago realizado</span>
                <span>{{ $reserva->paid_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="d-flex justify-content-between mt-2" style="font-size:.88rem">
                <span class="text-muted">Metodo</span>
                <span>{{ $reserva->paymentMethodLabel() }}@if($reserva->payment_last4) terminada en {{ $reserva->payment_last4 }}@endif</span>
            </div>
            @endif
        </div>
    </div>

    {{-- ACCIONES --}}
    <div class="d-flex gap-2 flex-wrap">
        @if($reserva->estado === 'pendiente')
        <a href="{{ route('reservas.checkout',$reserva) }}" class="btn btn-danger fw-bold">
            <i class="fas fa-credit-card me-2"></i>Completar pago
        </a>
        @endif
        @if(in_array($reserva->estado, ['confirmada', 'completada']))
        <a href="{{ route('reservas.recibo',$reserva) }}" class="btn btn-outline-success fw-bold">
            <i class="fas fa-file-invoice me-2"></i>Ver recibo
        </a>
        @endif
        <a href="{{ route('itinerarios.show',$reserva->itinerario->slug) }}" class="btn btn-outline-secondary">Ver itinerario</a>
        @if($reserva->cancelable())
        <form method="POST" action="{{ route('reservas.cancelar',$reserva) }}" onsubmit="return confirm('Seguro que quieres cancelar?')">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Cancelar reserva</button>
        </form>
        @endif
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Volver a mis reservas</a>
    </div>
</div>
@endsection
