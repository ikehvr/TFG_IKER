@extends('layouts.app')
@section('title','Usuarios Admin - JapanStyle')

@section('content')
<div class="container-fluid py-4 px-4">
    <h3 class="fw-bold mb-4">Gestion de Usuarios</h3>

    <form method="GET" action="{{ route('admin.usuarios') }}" class="d-flex gap-2 mb-4">
        <input type="text" name="search" class="form-control" style="max-width:300px"
               placeholder="Buscar por nombre o email..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-danger">Buscar</button>
        @if(request('search'))
        <a href="{{ route('admin.usuarios') }}" class="btn btn-outline-secondary">Limpiar</a>
        @endif
    </form>

    <div class="card border-0 shadow-sm" style="border-radius:12px;overflow:hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background:#f8f4ef">
                    <tr>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600;padding:.75rem 1.25rem">Usuario</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Registro</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Reservas</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Rol</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $u)
                    <tr>
                        <td style="padding:.85rem 1.25rem">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:34px;height:34px;border-radius:50%;background:#BC002D;color:#fff;display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:700;flex-shrink:0">
                                    {{ strtoupper(substr($u->name,0,1)) }}
                                </div>
                                <div>
                                    <div style="font-weight:600;font-size:.88rem">{{ $u->name }}</div>
                                    <div style="font-size:.75rem;color:#aaa">{{ $u->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:.85rem">{{ $u->created_at->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-light text-dark" style="font-size:.78rem;border:1px solid #ddd">
                                {{ $u->reservas_count }} reservas
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $u->isAdmin() ? 'bg-danger' : 'bg-secondary' }}" style="font-size:.72rem">
                                {{ $u->isAdmin() ? 'Admin' : 'Usuario' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-5 text-muted">No hay usuarios</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($usuarios->hasPages())
    <div class="d-flex justify-content-center mt-4">{{ $usuarios->links() }}</div>
    @endif
</div>
@endsection
