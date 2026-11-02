@extends('layouts.app')
@section('title','Reservas Admin - JapanStyle')

@section('content')
<div class="container-fluid py-4 px-4">
    <h3 class="fw-bold mb-4">Gestión de Reservas</h3>

    <form method="GET" action="{{ route('admin.reservas') }}" class="d-flex gap-2 mb-4 flex-wrap">
        <select name="estado" class="form-select" style="max-width:160px" onchange="this.form.submit()">
            <option value="">Todos los estados</option>
            @foreach(['pendiente','confirmada','cancelada','completada'] as $e)
            <option value="{{ $e }}" {{ request('estado')==$e?'selected':'' }}>{{ ucfirst($e) }}</option>
            @endforeach
        </select>
        @if(session('success'))<span class="text-success align-self-center small">{{ session('success') }}</span>@endif
    </form>

    <div class="card border-0 shadow-sm" style="border-radius:12px;overflow:hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background:#f8f4ef">
                    <tr>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600;padding:.75rem 1.25rem">#</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Usuario</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Itinerario</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Fecha</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Total</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Estado</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Cambiar estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservas as $r)
                    <tr>
                        <td style="padding:.85rem 1.25rem;color:#aaa;font-size:.82rem">{{ $r->id }}</td>
                        <td>
                            <div style="font-weight:500;font-size:.85rem">{{ $r->user->name }}</div>
                            <div style="font-size:.72rem;color:#aaa">{{ $r->user->email }}</div>
                        </td>
                        <td style="font-size:.85rem">{{ Str::limit($r->itinerario->titulo,25) }}</td>
                        <td style="font-size:.85rem">{{ $r->fecha_salida->format('d/m/Y') }}</td>
                        <td style="font-weight:600;font-size:.88rem">{{ number_format($r->total,0,',','.') }} EUR</td>
                        <td><span class="badge-{{ $r->estado }}">{{ $r->estadoLabel() }}</span></td>
                        <td>
                            <form method="POST" action="{{ route('admin.reservas.update',$r) }}" class="d-flex gap-1">
                                @csrf @method('PATCH')
                                <select name="estado" class="form-select form-select-sm" style="font-size:.78rem;width:auto">
                                    @foreach(['pendiente','confirmada','cancelada','completada'] as $e)
                                    <option value="{{ $e }}" {{ $r->estado==$e?'selected':'' }}>{{ ucfirst($e) }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-danger" style="font-size:.72rem;white-space:nowrap">OK</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-5 text-muted">No hay reservas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($reservas->hasPages())
    <div class="d-flex justify-content-center mt-4">{{ $reservas->links() }}</div>
    @endif
</div>
@endsection
