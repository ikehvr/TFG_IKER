@extends('layouts.app')
@section('title', $itinerario->titulo . ' - JapanStyle')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($itinerario->descripcion_corta ?: $itinerario->descripcion_larga), 155))
@section('meta_keywords', implode(', ', array_filter([
    $itinerario->titulo,
    $itinerario->destino_principal,
    $itinerario->categoria,
    'itinerario Japón',
    'viaje a Japón',
])))
@section('canonical', route('itinerarios.show', $itinerario->slug))
@section('og_type', 'product')
@section('og_title', $itinerario->titulo . ' | Itinerario por Japón')
@section('og_description', \Illuminate\Support\Str::limit(strip_tags($itinerario->descripcion_corta ?: $itinerario->descripcion_larga), 155))
@section('og_url', route('itinerarios.show', $itinerario->slug))
@section('og_image', asset($itinerario->imagen_principal))

@push('head')
    @php
        $seoDescripcion = \Illuminate\Support\Str::limit(strip_tags($itinerario->descripcion_corta ?: $itinerario->descripcion_larga), 155);
        $valoraciones = $itinerario->resenas;
        $mediaSeo = $valoraciones->count() > 0 ? round($valoraciones->avg('puntuacion'), 1) : null;
    @endphp
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $itinerario->titulo,
            'description' => $seoDescripcion,
            'image' => [asset($itinerario->imagen_principal)],
            'brand' => [
                '@type' => 'Brand',
                'name' => 'JapanStyle',
            ],
            'category' => ucfirst($itinerario->categoria),
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'EUR',
                'price' => (float) $itinerario->precio_desde,
                'availability' => 'https://schema.org/InStock',
                'url' => route('itinerarios.show', $itinerario->slug),
            ],
            'aggregateRating' => $mediaSeo ? [
                '@type' => 'AggregateRating',
                'ratingValue' => $mediaSeo,
                'reviewCount' => $valoraciones->count(),
            ] : null,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
<div class="container py-5">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('itinerarios.categoria',$itinerario->categoria) }}" class="text-danger">{{ ucfirst($itinerario->categoria) }}</a></li>
            <li class="breadcrumb-item active">{{ $itinerario->titulo }}</li>
        </ol>
    </nav>

    <div class="row g-4">

        {{-- COLUMNA PRINCIPAL --}}
        <div class="col-lg-8">
            <div class="rounded-3 overflow-hidden mb-4" style="max-height:400px">
                <img src="{{ asset($itinerario->imagen_principal) }}" alt="{{ $itinerario->titulo }}"
                     style="width:100%;height:400px;object-fit:cover">
            </div>

            <div class="d-flex flex-wrap gap-2 mb-3">
                @if($itinerario->recomendado)
                    <span class="badge bg-danger py-2 px-3">Recomendado</span>
                @endif
                <span class="badge bg-secondary py-2 px-3">{{ ucfirst($itinerario->categoria) }}</span>
                <span class="badge bg-info py-2 px-3">{{ $itinerario->destino_principal }}</span>
                <span class="badge bg-warning text-dark py-2 px-3">{{ ucfirst($itinerario->presupuesto) }}</span>
            </div>

            <h1 class="fw-bold mb-3">{{ $itinerario->titulo }}</h1>

            {{-- STATS --}}
            <div class="row g-3 mb-4">
                @foreach([
                    ['icon'=>'fas fa-calendar-alt','val'=>$itinerario->duracion_dias.' días','lbl'=>'Duración'],
                    ['icon'=>'fas fa-map-marker-alt','val'=>$itinerario->destino_principal,'lbl'=>'Base'],
                    ['icon'=>'fas fa-euro-sign','val'=>ucfirst($itinerario->presupuesto),'lbl'=>'Presupuesto'],
                    ['icon'=>'fas fa-user','val'=>($itinerario->primera_vez=='si'?'Ideal':'Avanzado'),'lbl'=>'Perfil'],
                ] as $s)
                <div class="col-6 col-md-3">
                    <div class="card border-0 text-center p-3" style="background:#f8f4ef;border-radius:8px">
                        <i class="{{ $s['icon'] }} mb-1" style="color:#BC002D"></i>
                        <div style="font-weight:700;font-size:.95rem">{{ $s['val'] }}</div>
                        <div style="font-size:.7rem;color:#aaa;text-transform:uppercase;letter-spacing:.05em">{{ $s['lbl'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- DESCRIPCION --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:10px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-info-circle text-danger me-2"></i>Sobre este viaje</h5>
                    <p class="text-muted" style="line-height:1.8">{{ $itinerario->descripcion_larga ?? $itinerario->descripcion_corta }}</p>
                </div>
            </div>

            {{-- DESTINOS --}}
            @if($itinerario->destinos->count() > 0)
            <div class="card border-0 shadow-sm mb-4" style="border-radius:10px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4"><i class="fas fa-map-marked-alt text-danger me-2"></i>Lugares que visitarás</h5>
                    <div class="row g-3">
                        @foreach($itinerario->destinos as $d)
                        <div class="col-md-6">
                            <div class="d-flex gap-3">
                                <span class="badge bg-danger rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                      style="width:28px;height:28px;font-size:.75rem">{{ $loop->iteration }}</span>
                                <div>
                                    <div class="fw-bold" style="font-size:.9rem">{{ $d->nombre }}</div>
                                    <div class="text-muted small">{{ $d->ciudad }}</div>
                                    @if($d->descripcion)<div class="small text-muted mt-1">{{ $d->descripcion }}</div>@endif
                                    <div class="small mt-1" style="color:{{ $d->precio_estimado > 0 ? '#BC002D' : '#27ae60' }}">
                                        {{ $d->precio_estimado > 0 ? 'Entrada: '.number_format($d->precio_estimado,0).' EUR' : 'Entrada gratuita' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- QUE INCLUYE --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:10px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-check-circle text-danger me-2"></i>¿Qué incluye?</h5>
                    <div class="row g-2">
                        @foreach([
                            [true,'Guia de itinerario en PDF'],[true,'Recomendaciones de restaurantes'],
                            [true,'Soporte online'],[true,'Entradas incluidas'],
                            [false,'Vuelos internacionales'],[false,'Alojamiento'],
                        ] as [$inc,$item])
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2" style="font-size:.85rem">
                                <i class="{{ $inc ? 'fas fa-check text-success' : 'fas fa-times text-danger' }}" style="width:16px"></i>
                                <span class="{{ $inc ? '' : 'text-muted' }}">{{ $item }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @include('partials.skyscanner-cta')

            {{-- ===================== COMENTARIOS ===================== --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:10px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-comments text-danger me-2"></i>
                        Opiniones
                        @if($itinerario->resenas->count() > 0)
                            <span class="badge bg-light text-dark ms-2" style="font-size:.75rem;font-weight:500">
                                {{ $itinerario->resenas->count() }}
                                {{ $itinerario->resenas->count() == 1 ? 'opinión' : 'opiniones' }}
                            </span>
                            @php
                                $media = round($itinerario->resenas->avg('puntuacion'), 1);
                            @endphp
                            <span class="ms-2" style="font-size:.9rem;color:#f39c12">
                                @for($i=1;$i<=5;$i++)
                                    <i class="fa{{ $i <= round($media) ? 's' : 'r' }} fa-star"></i>
                                @endfor
                                <span style="font-size:.8rem;color:#888;font-weight:400"> {{ $media }}/5</span>
                            </span>
                        @endif
                    </h5>

                    {{-- LISTA DE COMENTARIOS --}}
                    @forelse($itinerario->resenas()->with('user')->latest()->get() as $resena)
                    <div class="d-flex gap-3 mb-4 pb-4 {{ !$loop->last ? 'border-bottom' : '' }}">
                        @if($resena->user->profilePhotoUrl())
                            <img src="{{ $resena->user->profilePhotoUrl() }}" alt="{{ $resena->user->name }}"
                                 style="width:40px;height:40px;border-radius:50%;object-fit:cover;flex-shrink:0">
                        @else
                            <div style="width:40px;height:40px;border-radius:50%;background:#BC002D;color:#fff;display:flex;align-items:center;justify-content:center;font-size:.85rem;font-weight:700;flex-shrink:0">
                                {{ strtoupper(substr($resena->user->name,0,1)) }}
                            </div>
                        @endif
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-1">
                                <div>
                                    <span style="font-weight:600;font-size:.9rem">{{ $resena->user->name }}</span>
                                    <span class="text-muted small ms-2">{{ $resena->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span style="color:#f39c12;font-size:.85rem">
                                        @for($i=1;$i<=5;$i++)
                                            <i class="fa{{ $i <= $resena->puntuacion ? 's' : 'r' }} fa-star"></i>
                                        @endfor
                                    </span>
                                    @auth
                                        @if(Auth::id() == $resena->user_id || Auth::user()->isAdmin())
                                        <form method="POST" action="{{ route('resenas.destroy',$resena) }}"
                                              onsubmit="return confirm('Eliminar este comentario?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm p-0 text-muted" style="font-size:.75rem;border:none;background:none">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <p class="text-muted mt-1 mb-0" style="font-size:.88rem;line-height:1.6">{{ $resena->comentario }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted small mb-4">Aún no hay opiniones. Sé el primero en comentar.</p>
                    @endforelse

                    {{-- FORMULARIO NUEVO COMENTARIO --}}
                    @auth
                        @php
                            $yaComento = $itinerario->resenas()->where('user_id', Auth::id())->exists();
                        @endphp
                        @if(!$yaComento)
                        <div class="border-top pt-4 mt-2">
                            <h6 class="fw-bold mb-3">Deja tu opinión</h6>
                            <form method="POST" action="{{ route('resenas.store', $itinerario->slug) }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" style="font-size:.82rem;font-weight:600">Puntuación *</label>
                                    <div class="d-flex gap-2">
                                        @for($i=1;$i<=5;$i++)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="puntuacion"
                                                   id="star{{ $i }}" value="{{ $i }}" required>
                                            <label class="form-check-label" for="star{{ $i }}" style="color:#f39c12">
                                                {{ $i }} <i class="fas fa-star" style="font-size:.8rem"></i>
                                            </label>
                                        </div>
                                        @endfor
                                    </div>
                                    @error('puntuacion')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" style="font-size:.82rem;font-weight:600">Comentario * <span class="text-muted fw-normal">(mínimo 10 caracteres)</span></label>
                                    <textarea name="comentario" class="form-control @error('comentario') is-invalid @enderror"
                                              rows="3" maxlength="500"
                                              placeholder="Cuenta tu experiencia con este itinerario...">{{ old('comentario') }}</textarea>
                                    @error('comentario')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-paper-plane me-2"></i>Publicar comentario
                                </button>
                            </form>
                        </div>
                        @else
                        <div class="border-top pt-3 mt-2">
                            <p class="text-muted small mb-0"><i class="fas fa-check-circle text-success me-1"></i>Ya has dejado tu opinión en este itinerario.</p>
                        </div>
                        @endif
                    @else
                    <div class="border-top pt-3 mt-2">
                        <p class="text-muted small mb-2">
                            <a href="{{ route('login') }}" class="text-danger fw-bold">Inicia sesión</a>
                            para dejar tu opinión sobre este itinerario.
                        </p>
                    </div>
                    @endauth
                </div>
            </div>
            {{-- ===================== FIN COMENTARIOS ===================== --}}

            {{-- RELACIONADOS --}}
            @if($relacionados->count() > 0)
            <h5 class="fw-bold mb-3">También te puede interesar</h5>
            <div class="row g-3">
                @foreach($relacionados as $r)
                <div class="col-md-4">
                    <a href="{{ route('itinerarios.show',$r->slug) }}" class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm h-100" style="border-radius:8px;overflow:hidden">
                            <img src="{{ asset($r->imagen_principal) }}" style="height:100px;object-fit:cover;width:100%" alt="{{ $r->titulo }}">
                            <div class="card-body p-3">
                                <div style="font-size:.82rem;font-weight:600">{{ $r->titulo }}</div>
                                <div class="text-muted small">{{ $r->duracion_dias }}d | Desde {{ number_format($r->precio_desde,0,',','.') }} EUR</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- SIDEBAR RESERVA --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg sticky-top" style="top:85px;border-radius:12px;overflow:hidden">
                <div class="card-header text-white text-center py-4" style="background:#1a1a1a">
                    <div style="font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:rgba(255,255,255,.5)">Precio desde</div>
                    <div style="font-size:2.2rem;font-weight:700">{{ number_format($itinerario->precio_desde,0,',','.') }} &euro;</div>
                    <div style="font-size:.82rem;color:rgba(255,255,255,.55)">por persona</div>
                </div>
                <div class="card-body p-4">
                    @auth
                    <form action="{{ route('reservas.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="itinerario_id" value="{{ $itinerario->id }}">
                        <div class="mb-3">
                            <label class="form-label" style="font-size:.78rem;font-weight:600">Fecha de salida</label>
                            <input type="date" name="fecha_salida" class="form-control @error('fecha_salida') is-invalid @enderror"
                                   min="{{ now()->addDays(7)->format('Y-m-d') }}" required onchange="calcTotal()">
                            @error('fecha_salida')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="font-size:.78rem;font-weight:600">Numero de viajeros</label>
                            <select name="n_viajeros" class="form-select" id="viajeros" onchange="calcTotal()">
                                @for($i=1;$i<=10;$i++)
                                <option value="{{ $i }}">{{ $i }} {{ $i==1?'viajero':'viajeros' }}</option>
                                @endfor
                            </select>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-1" style="font-size:.84rem">
                            <span class="text-muted">Precio/persona</span>
                            <span>{{ number_format($itinerario->precio_desde,0,',','.') }} EUR</span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold pt-2 border-top">
                            <span>Total estimado</span>
                            <span style="color:#BC002D;font-size:1.1rem" id="total-display">{{ number_format($itinerario->precio_desde,0,',','.') }} EUR</span>
                        </div>
                        <button type="submit" class="btn w-100 mt-3 py-2 fw-bold" style="background:#BC002D;color:#fff;border-radius:6px">
                            <i class="fas fa-calendar-check me-2"></i>Reservar ahora
                        </button>
                    </form>
                    @else
                    <div class="text-center">
                        <p class="text-muted small mb-3">Inicia sesion para reservar este itinerario.</p>
                        <a href="{{ route('login') }}" class="btn w-100 mb-2 fw-bold" style="background:#BC002D;color:#fff;border-radius:6px">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesion
                        </a>
                        <a href="{{ route('register') }}" class="btn w-100" style="border:1.5px solid #BC002D;color:#BC002D;border-radius:6px">
                            <i class="fas fa-user-plus me-2"></i>Crear cuenta gratis
                        </a>
                    </div>
                    @endauth
                </div>
                <div class="card-footer bg-white border-0 text-center pb-3" style="font-size:.75rem;color:#aaa">
                    Pago seguro | Cancelacion gratuita 48h antes
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const precio = {{ $itinerario->precio_desde }};
function calcTotal() {
    const n = parseInt(document.getElementById('viajeros').value || 1);
    document.getElementById('total-display').textContent = (precio * n).toLocaleString('es-ES') + ' EUR';
}
</script>
@endpush
@endsection
