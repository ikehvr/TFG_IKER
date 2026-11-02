@extends('layouts.app')
@section('title','Mis reservas - JapanStyle')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Mis reservas</h2>
            <p class="text-muted mb-0">Hola, <strong>{{ $user->name }}</strong></p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-danger">
            <i class="fas fa-plus me-2"></i>Nueva reserva
        </a>
    </div>

    {{-- STATS --}}
    <div class="row g-3 mb-5">
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius:10px">
                <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa">Total viajes</div>
                <div style="font-size:2rem;font-weight:700;color:#1a1a1a">{{ $stats['total'] }}</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius:10px">
                <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa">Confirmadas</div>
                <div style="font-size:2rem;font-weight:700;color:#198754">{{ $stats['confirmadas'] }}</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius:10px">
                <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa">Pendientes</div>
                <div style="font-size:2rem;font-weight:700;color:#fd7e14">{{ $stats['pendientes'] }}</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius:10px">
                <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa">Total gastado</div>
                <div style="font-size:1.5rem;font-weight:700;color:#BC002D">{{ number_format($stats['gastado'],0,',','.') }} EUR</div>
            </div>
        </div>
    </div>

    @if($reservas->isEmpty())
    <div class="card border-0 shadow-sm text-center py-5" style="border-radius:12px">
        <i class="fas fa-plane fa-3x text-muted mb-3"></i>
        <h5 class="fw-bold">Aún no tienes reservas</h5>
        <p class="text-muted">Explora nuestros itinerarios y reserva tu próximo viaje a Japón.</p>
        <div class="mt-2"><a href="{{ route('home') }}" class="btn btn-danger px-4">Ver itinerarios</a></div>
    </div>
    @else
    <div class="card border-0 shadow-sm" style="border-radius:12px;overflow:hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background:#f8f4ef">
                    <tr>
                        <th style="font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:#888;font-weight:600;padding:1rem">Itinerario</th>
                        <th style="font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:#888;font-weight:600">Fecha salida</th>
                        <th style="font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:#888;font-weight:600">Viajeros</th>
                        <th style="font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:#888;font-weight:600">Total</th>
                        <th style="font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:#888;font-weight:600">Estado</th>
                        <th style="font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:#888;font-weight:600">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $r)
                    <tr>
                        <td style="padding:1rem">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset($r->itinerario->imagen_principal) }}"
                                     style="width:50px;height:36px;object-fit:cover;border-radius:5px;flex-shrink:0" alt="">
                                <div>
                                    <div style="font-weight:600;font-size:.88rem">{{ $r->itinerario->titulo }}</div>
                                    <div style="font-size:.75rem;color:#aaa">{{ $r->itinerario->duracion_dias }}d | {{ $r->itinerario->destino_principal }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:.85rem">{{ $r->fecha_salida->format('d/m/Y') }}</td>
                        <td style="font-size:.85rem">{{ $r->n_viajeros }}</td>
                        <td style="font-weight:600;font-size:.9rem">{{ number_format($r->total,0,',','.') }} EUR</td>
                        <td><span class="badge-{{ $r->estado }}">{{ $r->estadoLabel() }}</span></td>
                        <td>
                            <div class="d-flex gap-1 flex-wrap">
                                <a href="{{ route('reservas.show',$r) }}" class="btn btn-sm btn-outline-secondary" style="font-size:.75rem">Ver</a>
                                @if($r->estado === 'pendiente')
                                <a href="{{ route('reservas.checkout',$r) }}" class="btn btn-sm btn-danger" style="font-size:.75rem">Pagar</a>
                                @endif
                                @if(in_array($r->estado, ['confirmada', 'completada']))
                                <a href="{{ route('reservas.recibo',$r) }}" class="btn btn-sm btn-outline-success" style="font-size:.75rem">Recibo</a>
                                @endif
                                @if($r->cancelable())
                                <form method="POST" action="{{ route('reservas.cancelar',$r) }}"
                                      onsubmit="return confirm('&iquest;Cancelar esta reserva?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="font-size:.75rem">Cancelar</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
