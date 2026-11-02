@extends('layouts.app')
@section('title','Panel Admin - JapanStyle')

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold mb-0">Panel de Administración</h3>
            <p class="text-muted small mb-0">Bienvenido, {{ auth()->user()->name }}</p>
        </div>
        <a href="{{ route('admin.itinerarios.create') }}" class="btn btn-danger">
            <i class="fas fa-plus me-2"></i>Nuevo itinerario
        </a>
    </div>

    {{-- STATS --}}
    <div class="row g-3 mb-4">
        @foreach([
            ['label'=>'Itinerarios','value'=>$stats['itinerarios'],'color'=>'#165096','icon'=>'fas fa-map'],
            ['label'=>'Usuarios',   'value'=>$stats['usuarios'],   'color'=>'#198754','icon'=>'fas fa-users'],
            ['label'=>'Reservas',   'value'=>$stats['reservas'],   'color'=>'#8c5a14','icon'=>'fas fa-calendar-check'],
            ['label'=>'Pendientes', 'value'=>$stats['pendientes'], 'color'=>'#fd7e14','icon'=>'fas fa-clock'],
            ['label'=>'Ingresos',   'value'=>number_format($stats['ingresos'],0,',','.').' EUR','color'=>'#BC002D','icon'=>'fas fa-euro-sign'],
        ] as $s)
        <div class="col-6 col-lg">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius:10px">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:40px;height:40px;border-radius:8px;background:{{ $s['color'] }}18;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="{{ $s['icon'] }}" style="color:{{ $s['color'] }}"></i>
                    </div>
                    <div>
                        <div style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa">{{ $s['label'] }}</div>
                        <div style="font-size:1.3rem;font-weight:700;color:#1a1a1a;line-height:1.1">{{ $s['value'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ACCESOS RÁPIDOS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <a href="{{ route('admin.itinerarios') }}" class="card border-0 shadow-sm p-3 text-decoration-none text-dark d-flex flex-row align-items-center gap-3" style="border-radius:10px">
                <i class="fas fa-map fa-lg text-danger"></i>
                <span class="fw-600">Gestionar itinerarios</span>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.reservas') }}" class="card border-0 shadow-sm p-3 text-decoration-none text-dark d-flex flex-row align-items-center gap-3" style="border-radius:10px">
                <i class="fas fa-calendar-check fa-lg text-danger"></i>
                <span>Gestionar reservas</span>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.usuarios') }}" class="card border-0 shadow-sm p-3 text-decoration-none text-dark d-flex flex-row align-items-center gap-3" style="border-radius:10px">
                <i class="fas fa-users fa-lg text-danger"></i>
                <span>Gestionar usuarios</span>
            </a>
        </div>
    </div>

    {{-- ÚLTIMAS RESERVAS --}}
    <div class="card border-0 shadow-sm" style="border-radius:12px;overflow:hidden">
        <div class="d-flex justify-content-between align-items-center p-4 pb-0">
            <h6 class="fw-bold mb-0">Últimas reservas</h6>
            <a href="{{ route('admin.reservas') }}" class="small text-danger">Ver todas</a>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-hover align-middle mb-0">
                <thead style="background:#f8f4ef">
                    <tr>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600;padding:.75rem 1.25rem">#</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Usuario</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Itinerario</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Fecha</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Total</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ultimasReservas as $r)
                    <tr>
                        <td style="padding:.85rem 1.25rem;color:#aaa;font-size:.82rem">{{ $r->id }}</td>
                        <td>
                            <div style="font-weight:500;font-size:.85rem">{{ $r->user->name }}</div>
                            <div style="font-size:.72rem;color:#aaa">{{ $r->user->email }}</div>
                        </td>
                        <td style="font-size:.85rem">{{ Str::limit($r->itinerario->titulo,28) }}</td>
                        <td style="font-size:.85rem">{{ $r->fecha_salida->format('d/m/Y') }}</td>
                        <td style="font-weight:600;font-size:.88rem">{{ number_format($r->total,0,',','.') }} EUR</td>
                        <td><span class="badge-{{ $r->estado }}">{{ $r->estadoLabel() }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">Sin reservas todavía</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
