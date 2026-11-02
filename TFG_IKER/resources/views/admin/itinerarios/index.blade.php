@extends('layouts.app')
@section('title','Itinerarios Admin - JapanStyle')

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h3 class="fw-bold mb-0">Gestión de Itinerarios</h3>
        <a href="{{ route('admin.itinerarios.create') }}" class="btn btn-danger">
            <i class="fas fa-plus me-2"></i>Nuevo itinerario
        </a>
    </div>

    <form method="GET" action="{{ route('admin.itinerarios') }}" class="d-flex gap-2 mb-4 flex-wrap">
        <input type="text" name="search" class="form-control" style="max-width:260px"
               placeholder="Buscar por titulo..." value="{{ request('search') }}">
        <select name="categoria" class="form-select" style="max-width:160px" onchange="this.form.submit()">
            <option value="">Todas</option>
            @foreach(['tradicional','moderno','anime','naturaleza','mixto'] as $c)
            <option value="{{ $c }}" {{ request('categoria')==$c?'selected':'' }}>{{ ucfirst($c) }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-danger">Buscar</button>
        @if(request()->hasAny(['search','categoria']))
        <a href="{{ route('admin.itinerarios') }}" class="btn btn-outline-secondary">Limpiar</a>
        @endif
    </form>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

    <div class="card border-0 shadow-sm" style="border-radius:12px;overflow:hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background:#f8f4ef">
                    <tr>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600;padding:.75rem 1.25rem">Imágen</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Título</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Categoría</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Días</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Precio</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Estado</th>
                        <th style="font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:#aaa;font-weight:600">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($itinerarios as $it)
                    <tr>
                        <td style="padding:.85rem 1.25rem">
                            <img src="{{ asset($it->imagen_principal) }}" style="width:55px;height:40px;object-fit:cover;border-radius:5px" alt="">
                        </td>
                        <td>
                            <div style="font-weight:600;font-size:.88rem">{{ $it->titulo }}</div>
                            <div style="font-size:.72rem;color:#aaa">{{ $it->destino_principal }}</div>
                            @if($it->recomendado)<span class="badge bg-warning text-dark mt-1" style="font-size:.62rem">Recomendado</span>@endif
                        </td>
                        <td><span class="badge bg-secondary" style="font-size:.7rem">{{ ucfirst($it->categoria) }}</span></td>
                        <td style="font-size:.85rem">{{ $it->duracion_dias }}d</td>
                        <td style="font-weight:600;font-size:.88rem">{{ number_format($it->precio_desde,0,',','.') }} EUR</td>
                        <td>
                            <span class="badge {{ $it->activo ? 'bg-success' : 'bg-secondary' }}" style="font-size:.7rem">
                                {{ $it->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('itinerarios.show',$it->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary" style="font-size:.72rem">Ver</a>
                                <a href="{{ route('admin.itinerarios.edit',$it) }}" class="btn btn-sm btn-outline-primary" style="font-size:.72rem">Editar</a>
                                <form method="POST" action="{{ route('admin.itinerarios.destroy',$it) }}" onsubmit="return confirm('Eliminar este itinerario?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="font-size:.72rem">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-5 text-muted">No hay itinerarios</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($itinerarios->hasPages())
    <div class="d-flex justify-content-center mt-4">{{ $itinerarios->links() }}</div>
    @endif
</div>
@endsection
