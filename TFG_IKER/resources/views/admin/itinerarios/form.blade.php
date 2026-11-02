@extends('layouts.app')
@section('title', (isset($itinerario) ? 'Editar' : 'Nuevo') . ' Itinerario - Admin')

@section('content')
<div class="container py-4" style="max-width:800px">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">{{ isset($itinerario) ? 'Editar itinerario' : 'Nuevo itinerario' }}</h3>
        <a href="{{ route('admin.itinerarios') }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius:12px">
        <div class="card-body p-4">
            <form method="POST"
                  action="{{ isset($itinerario) ? route('admin.itinerarios.update',$itinerario) : route('admin.itinerarios.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($itinerario)) @method('PUT') @endif

                <h6 class="fw-bold mb-3" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.1em;color:#aaa">Información básica</h6>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:.82rem">Título *</label>
                    <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror"
                           value="{{ old('titulo',$itinerario->titulo??'') }}" required>
                    @error('titulo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:.82rem">Descripción corta *</label>
                    <textarea name="descripcion_corta" class="form-control @error('descripcion_corta') is-invalid @enderror"
                              rows="2" maxlength="500" required>{{ old('descripcion_corta',$itinerario->descripcion_corta??'') }}</textarea>
                    @error('descripcion_corta')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold" style="font-size:.82rem">Descripción larga</label>
                    <textarea name="descripcion_larga" class="form-control" rows="4">{{ old('descripcion_larga',$itinerario->descripcion_larga??'') }}</textarea>
                </div>

                <h6 class="fw-bold mb-3" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.1em;color:#aaa">Clasificación</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" style="font-size:.82rem">Categoría *</label>
                        <select name="categoria" class="form-select @error('categoria') is-invalid @enderror" required>
                            @foreach(['tradicional','moderno','anime','naturaleza','mixto'] as $c)
                            <option value="{{ $c }}" {{ old('categoria',$itinerario->categoria??'')==$c?'selected':'' }}>{{ ucfirst($c) }}</option>
                            @endforeach
                        </select>
                        @error('categoria')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" style="font-size:.82rem">Presupuesto *</label>
                        <select name="presupuesto" class="form-select" required>
                            <option value="economico" {{ old('presupuesto',$itinerario->presupuesto??'')=='economico'?'selected':'' }}>Economico</option>
                            <option value="medio"     {{ old('presupuesto',$itinerario->presupuesto??'')=='medio'    ?'selected':'' }}>Medio</option>
                            <option value="lujo"      {{ old('presupuesto',$itinerario->presupuesto??'')=='lujo'     ?'selected':'' }}>Lujo</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" style="font-size:.82rem">¿Primera vez? *</label>
                        <select name="primera_vez" class="form-select" required>
                            <option value="si" {{ old('primera_vez',$itinerario->primera_vez??'')=='si'?'selected':'' }}>Si</option>
                            <option value="no" {{ old('primera_vez',$itinerario->primera_vez??'')=='no'?'selected':'' }}>No</option>
                        </select>
                    </div>
                </div>

                <h6 class="fw-bold mb-3" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.1em;color:#aaa">Detalles</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" style="font-size:.82rem">Duración (días) *</label>
                        <input type="number" name="duracion_dias" class="form-control @error('duracion_dias') is-invalid @enderror"
                               value="{{ old('duracion_dias',$itinerario->duracion_dias??'') }}" min="1" max="30" required>
                        @error('duracion_dias')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" style="font-size:.82rem">Precio desde (EUR) *</label>
                        <input type="number" name="precio_desde" class="form-control @error('precio_desde') is-invalid @enderror"
                               value="{{ old('precio_desde',$itinerario->precio_desde??'') }}" min="0" step="0.01" required>
                        @error('precio_desde')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" style="font-size:.82rem">Destino principal *</label>
                        <input type="text" name="destino_principal" class="form-control @error('destino_principal') is-invalid @enderror"
                               value="{{ old('destino_principal',$itinerario->destino_principal??'') }}" required>
                        @error('destino_principal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h6 class="fw-bold mb-3" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.1em;color:#aaa">Imagen</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.82rem">
                            Imagen principal {{ isset($itinerario) ? '(dejar vacio para mantener)' : '' }}
                        </label>
                        <input type="file" name="imagen_principal" class="form-control" accept="image/*">
                    </div>
                    @if(isset($itinerario) && $itinerario->imagen_principal)
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.82rem">Imagen actual</label>
                        <img src="{{ asset($itinerario->imagen_principal) }}" style="height:70px;border-radius:6px;object-fit:cover" alt="">
                    </div>
                    @endif
                </div>

                <h6 class="fw-bold mb-3" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.1em;color:#aaa">Opciones</h6>
                <div class="d-flex gap-4 mb-4">
                    <div class="form-check form-switch">
                        <input type="hidden" name="recomendado" value="0">
                        <input class="form-check-input" type="checkbox" name="recomendado" value="1" id="recomendado"
                               {{ old('recomendado',$itinerario->recomendado??false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="recomendado" style="font-size:.88rem">Marcar como recomendado</label>
                    </div>
                    <div class="form-check form-switch">
                        <input type="hidden" name="activo" value="0">
                        <input class="form-check-input" type="checkbox" name="activo" value="1" id="activo"
                               {{ old('activo',$itinerario->activo??true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="activo" style="font-size:.88rem">Itinerario activo</label>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="fas fa-save me-2"></i>{{ isset($itinerario) ? 'Guardar cambios' : 'Crear itinerario' }}
                    </button>
                    <a href="{{ route('admin.itinerarios') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
