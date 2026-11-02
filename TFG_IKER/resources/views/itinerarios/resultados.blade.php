@extends('layouts.app')
@section('title','Resultados de busqueda - JapanStyle')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger">Inicio</a></li>
            <li class="breadcrumb-item active">Resultados</li>
        </ol>
    </nav>

    @include('partials.skyscanner-cta')

    <div class="row g-4">
        {{-- FILTROS --}}
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm sticky-top" style="top:85px;border-radius:10px">
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-3" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.08em;color:#888">Filtrar</h6>
                    <form method="POST" action="{{ route('itinerarios.buscar') }}" id="fform">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" style="font-size:.78rem;font-weight:600">Duracion</label>
                            <select name="dias" class="form-select form-select-sm" onchange="document.getElementById('fform').submit()">
                                <option value="todos" {{ ($filtros['dias']??'todos')=='todos'?'selected':'' }}>Cualquiera</option>
                                <option value="7"  {{ ($filtros['dias']??'')=='7' ?'selected':'' }}>Hasta 7 dias</option>
                                <option value="14" {{ ($filtros['dias']??'')=='14'?'selected':'' }}>Hasta 14 dias</option>
                                <option value="21" {{ ($filtros['dias']??'')=='21'?'selected':'' }}>Mas de 15 dias</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="font-size:.78rem;font-weight:600">Tematica</label>
                            <select name="estilo" class="form-select form-select-sm" onchange="document.getElementById('fform').submit()">
                                <option value="todos" {{ ($filtros['estilo']??'todos')=='todos'?'selected':'' }}>Todas</option>
                                <option value="tradicional" {{ ($filtros['estilo']??'')=='tradicional'?'selected':'' }}>Tradicional</option>
                                <option value="moderno"     {{ ($filtros['estilo']??'')=='moderno'    ?'selected':'' }}>Moderno</option>
                                <option value="anime"       {{ ($filtros['estilo']??'')=='anime'      ?'selected':'' }}>Anime</option>
                                <option value="naturaleza"  {{ ($filtros['estilo']??'')=='naturaleza' ?'selected':'' }}>Naturaleza</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="font-size:.78rem;font-weight:600">Presupuesto</label>
                            <select name="presupuesto" class="form-select form-select-sm" onchange="document.getElementById('fform').submit()">
                                <option value="todos"    {{ ($filtros['presupuesto']??'todos')=='todos'    ?'selected':'' }}>Cualquiera</option>
                                <option value="economico"{{ ($filtros['presupuesto']??'')=='economico'?'selected':'' }}>Economico</option>
                                <option value="medio"    {{ ($filtros['presupuesto']??'')=='medio'    ?'selected':'' }}>Medio</option>
                                <option value="lujo"     {{ ($filtros['presupuesto']??'')=='lujo'     ?'selected':'' }}>Lujo</option>
                            </select>
                        </div>
                        <a href="{{ route('home') }}" class="btn btn-sm w-100" style="border:1px solid #ddd;color:#666;font-size:.8rem">
                            Limpiar filtros
                        </a>
                    </form>
                </div>
            </div>
        </div>

        {{-- RESULTADOS --}}
        <div class="col-lg-9">
            <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                <h5 class="mb-0">
                    <strong>{{ count($itinerarios) }}</strong>
                    <span class="text-muted fw-normal"> itinerarios encontrados</span>
                </h5>
            </div>

            @if($itinerarios->count() > 0)
            <div class="row g-4">
                @foreach($itinerarios as $it)
                <div class="col-md-6 col-xl-4">
                    <a href="{{ route('itinerarios.show',$it->slug) }}" class="text-decoration-none text-dark">
                        <div class="card card-itinerario h-100">
                            <div class="position-relative">
                                <img src="{{ asset($it->imagen_principal) }}" alt="{{ $it->titulo }}">
                                @if($it->recomendado)
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-2" style="font-size:.65rem">Top</span>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex gap-2 flex-wrap mb-2" style="font-size:.72rem;color:#999">
                                    <span>{{ $it->duracion_dias }} dias</span>
                                    <span>|</span>
                                    <span>{{ $it->destino_principal }}</span>
                                    <span>|</span>
                                    <span>{{ ucfirst($it->categoria) }}</span>
                                </div>
                                <h6 class="fw-bold mb-1">{{ $it->titulo }}</h6>
                                <p class="text-muted small flex-grow-1 mb-2">{{ Str::limit($it->descripcion_corta,80) }}</p>
                                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                    <div class="precio-destacado">{{ number_format($it->precio_desde,0,',','.') }} &euro; <small class="text-muted fw-normal" style="font-size:.7rem">/ pers.</small></div>
                                    <span class="btn btn-sm btn-outline-danger">Ver &rarr;</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h5>Sin resultados</h5>
                <p class="text-muted">Prueba a ampliar algun filtro.</p>
                <a href="{{ route('home') }}" class="btn btn-danger mt-2">Volver a buscar</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
