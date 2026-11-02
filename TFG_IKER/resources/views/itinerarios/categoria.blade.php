@extends('layouts.app')
@section('title', ucfirst($categoria) . ' - JapanStyle')

@section('content')
<div style="background:#BC002D;padding:3rem 0;color:#fff">
    <div class="container">
        <h1 class="fw-bold mb-1">Itinerarios {{ ucfirst($categoria) }}</h1>
        <p style="color:rgba(255,255,255,.75);margin:0">Encuentra tu viaje perfecto en esta categoria</p>
    </div>
</div>

<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger">Inicio</a></li>
            <li class="breadcrumb-item active">{{ ucfirst($categoria) }}</li>
        </ol>
    </nav>

    @include('partials.skyscanner-cta')

    @if($itinerarios->count() > 0)
    <div class="row g-4">
        @foreach($itinerarios as $it)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('itinerarios.show',$it->slug) }}" class="text-decoration-none text-dark">
                <div class="card card-itinerario h-100">
                    <div class="position-relative">
                        <img src="{{ asset($it->imagen_principal) }}" alt="{{ $it->titulo }}">
                        @if($it->recomendado)
                        <span class="badge bg-danger position-absolute top-0 start-0 m-2" style="font-size:.65rem">Recomendado</span>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex gap-3 mb-2" style="font-size:.75rem;color:#999">
                            <span><i class="fas fa-calendar-alt me-1"></i>{{ $it->duracion_dias }} días</span>
                            <span><i class="fas fa-map-marker-alt me-1"></i>{{ $it->destino_principal }}</span>
                        </div>
                        <h5 class="fw-bold">{{ $it->titulo }}</h5>
                        <p class="text-muted small flex-grow-1">{{ $it->descripcion_corta }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                            <div class="precio-destacado">{{ number_format($it->precio_desde,0,',','.') }} &euro; <small class="text-muted fw-normal" style="font-size:.7rem">/ pers.</small></div>
                            <span class="btn btn-sm btn-outline-danger">Ver &rarr;</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-5">{{ $itinerarios->links() }}</div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-map fa-3x text-muted mb-3"></i>
        <h5>No hay itinerarios en esta categoría todavía</h5>
        <a href="{{ route('home') }}" class="btn btn-danger mt-2">Volver al inicio</a>
    </div>
    @endif
</div>
@endsection
