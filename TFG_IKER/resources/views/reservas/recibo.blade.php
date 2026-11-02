@extends('layouts.app')
@section('title','Recibo de compra #' . $reserva->id . ' - JapanStyle')

@section('content')
<div class="container py-5" style="max-width:900px">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <div class="text-muted small text-uppercase fw-semibold" style="letter-spacing:.08em">Recibo de compra</div>
            <h1 class="fw-bold mb-0">Reserva #{{ $reserva->id }}</h1>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('reservas.show', $reserva) }}" class="btn btn-outline-danger">Volver a la reserva</a>
            <button type="button" onclick="window.print()" class="btn btn-danger">Imprimir recibo</button>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius:16px">
        <div class="card-body p-4 p-lg-5">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 pb-4 border-bottom mb-4">
                <div>
                    <h4 class="fw-bold mb-1">JapanStyle</h4>
                    <div class="text-muted small">Av. Francia 123, Vila-real, Castellon</div>
                    <div class="text-muted small">info@japanstyle.es | +34 643 225 530</div>
                </div>
                <div class="text-lg-end">
                    <div class="small text-muted">Referencia de recibo</div>
                    <div class="fw-bold">{{ $reserva->receipt_number ?? 'Pendiente' }}</div>
                    <div class="small text-muted mt-2">Fecha de pago</div>
                    <div class="fw-semibold">{{ optional($reserva->paid_at)->format('d/m/Y H:i') ?? 'No disponible' }}</div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <h6 class="fw-bold">Cliente</h6>
                    <div>{{ $reserva->user->name }}</div>
                    <div class="text-muted">{{ $reserva->user->email }}</div>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">Pago</h6>
                    <div>{{ $reserva->paymentMethodLabel() }}</div>
                    <div class="text-muted">
                        @if($reserva->payment_last4)
                            Tarjeta terminada en {{ $reserva->payment_last4 }}
                        @else
                            Metodo no disponible
                        @endif
                    </div>
                    <div class="text-muted">Operacion: {{ $reserva->stripe_payment_intent }}</div>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table align-middle">
                    <thead style="background:#f8f4ef">
                        <tr>
                            <th>Concepto</th>
                            <th>Fecha salida</th>
                            <th>Viajeros</th>
                            <th>Precio unidad</th>
                            <th class="text-end">Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $reserva->itinerario->titulo }}</div>
                                <div class="text-muted small">{{ $reserva->itinerario->destino_principal }} | {{ ucfirst($reserva->itinerario->categoria) }}</div>
                            </td>
                            <td>{{ $reserva->fecha_salida->format('d/m/Y') }}</td>
                            <td>{{ $reserva->n_viajeros }}</td>
                            <td>{{ number_format($reserva->precio_unitario, 0, ',', '.') }} EUR</td>
                            <td class="text-end fw-bold">{{ number_format($reserva->total, 0, ',', '.') }} EUR</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-end">
                <div class="col-md-5">
                    <div class="rounded-4 p-4" style="background:#f8f4ef">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>{{ number_format($reserva->total, 0, ',', '.') }} EUR</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Gastos de gestion</span>
                            <span>Incluidos</span>
                        </div>
                        <div class="d-flex justify-content-between pt-3 border-top fw-bold">
                            <span>Total pagado</span>
                            <span style="color:#BC002D">{{ number_format($reserva->total, 0, ',', '.') }} EUR</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-4 p-4 mt-4" style="background:rgba(22,80,150,.06);border:1px solid rgba(22,80,150,.08)">
                <div class="fw-semibold mb-1">Estado de la compra: {{ $reserva->estadoLabel() }}</div>
                <div class="text-muted small">Conserva este recibo como comprobante de pago de tu itinerario.</div>
            </div>
        </div>
    </div>
</div>
@endsection
