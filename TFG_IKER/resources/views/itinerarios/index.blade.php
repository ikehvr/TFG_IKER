@extends('layouts.app')
@section('title','JapanStyle - Viajes Tematicos a Japon')

@section('content')

{{-- HERO --}}
<section style="background: linear-gradient(rgba(0,0,0,0.55),rgba(0,0,0,0.55)), url('/images/itinerarios/gran-tour.jpg') center/cover no-repeat; min-height:580px; display:flex; align-items:center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-white text-center">
                <h1 class="display-4 fw-bold mb-3">Descubre Japón a tu manera</h1>
                <p class="lead mb-4" style="color:rgba(255,255,255,.8)">
                    Itinerarios temáticos especializados en tradición, anime, modernidad y naturaleza
                </p>
                <div class="card border-0 shadow p-4 text-start" style="border-radius:12px">
                    <h6 class="fw-bold mb-3 text-dark">Encuentra tu viaje ideal</h6>
                    <form action="{{ route('itinerarios.buscar') }}" method="POST">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-6 col-lg-3">
                                <label class="form-label text-dark" style="font-size:.8rem;font-weight:600">Duración</label>
                                <select name="dias" class="form-select form-select-sm">
                                    <option value="todos">Cualquiera</option>
                                    <option value="7">Hasta 7 días</option>
                                    <option value="14">Hasta 14 días</option>
                                    <option value="21">Más de 15 días</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <label class="form-label text-dark" style="font-size:.8rem;font-weight:600">Temática</label>
                                <select name="estilo" class="form-select form-select-sm">
                                    <option value="todos">Todas</option>
                                    <option value="tradicional">Tradicional</option>
                                    <option value="moderno">Moderno</option>
                                    <option value="anime">Anime</option>
                                    <option value="naturaleza">Naturaleza</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <label class="form-label text-dark" style="font-size:.8rem;font-weight:600">Presupuesto</label>
                                <select name="presupuesto" class="form-select form-select-sm">
                                    <option value="todos">Cualquiera</option>
                                    <option value="economico">Económico</option>
                                    <option value="medio">Medio</option>
                                    <option value="lujo">Lujo</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <label class="form-label text-dark" style="font-size:.8rem;font-weight:600">¿Primera vez?</label>
                                <select name="primera_vez" class="form-select form-select-sm">
                                    <option value="todos">Indistinto</option>
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-12 mt-1">
                                <button type="submit" class="btn w-100 fw-bold" style="background:#BC002D;color:#fff;border-radius:6px">
                                    <i class="fas fa-search me-2"></i>Buscar mi viaje ideal
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CATEGORIAS --}}
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Explora por temática</h2>
        <div class="row g-3">
            @foreach([
                ['slug'=>'tradicional','icon'=>'fas fa-torii-gate','nombre'=>'Japón Tradicional','sub'=>'Templos, samurais y geishas','img'=>'kinkakuji','color'=>'#6f4e37'],
                ['slug'=>'moderno',    'icon'=>'fas fa-city',        'nombre'=>'Tokio Moderno',    'sub'=>'Neon, tecnología y Shibuya','img'=>'tokio-moderno','color'=>'#165096'],
                ['slug'=>'anime',      'icon'=>'fas fa-star',        'nombre'=>'Anime y Pop',      'sub'=>'Akihabara, Ghibli y manga','img'=>'anime-tokyo','color'=>'#9b1e64'],
                ['slug'=>'naturaleza', 'icon'=>'fas fa-mountain',    'nombre'=>'Naturaleza',       'sub'=>'Fuji, bambú y onsens','img'=>'fuji','color'=>'#1e783c'],
            ] as $cat)
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('itinerarios.categoria',$cat['slug']) }}" class="text-decoration-none">
                    <div class="position-relative overflow-hidden rounded-3" style="height:220px">
                        <img src="/images/itinerarios/{{ $cat['img'] }}.jpg" alt="{{ $cat['nombre'] }}"
                             style="width:100%;height:100%;object-fit:cover;transition:transform .4s">
                        <div class="position-absolute inset-0 w-100 h-100 top-0"
                             style="background:linear-gradient(to top,rgba(0,0,0,.7) 0%,rgba(0,0,0,.1) 60%)"></div>
                        <div class="position-absolute bottom-0 p-3 text-white">
                            <i class="{{ $cat['icon'] }} mb-1 d-block" style="font-size:1.2rem"></i>
                            <div style="font-weight:700;font-size:1rem">{{ $cat['nombre'] }}</div>
                            <div style="font-size:.75rem;opacity:.8">{{ $cat['sub'] }}</div>
                            <span class="badge mt-1" style="background:rgba(255,255,255,.2);font-size:.68rem">
                                {{ $categorias[$cat['slug']] ?? 0 }} rutas
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- DESTACADOS --}}
<section class="py-5" style="background:#f8f4ef">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h2 class="fw-bold mb-1">Itinerarios destacados</h2>
                <p class="text-muted mb-0">Los viajes más valorados por nuestros viajeros</p>
            </div>
            <a href="{{ route('itinerarios.index') }}" class="btn-outline-rojo">Ver todos</a>
        </div>
        <div class="row g-4">
            @forelse($destacados as $it)
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('itinerarios.show',$it->slug) }}" class="text-decoration-none text-dark">
                    <div class="card card-itinerario h-100">
                        <div class="position-relative">
                            <img src="{{ asset($it->imagen_principal) }}" alt="{{ $it->titulo }}">
                            <div class="position-absolute top-0 start-0 m-2 d-flex gap-1 flex-wrap">
                                @if($it->recomendado)
                                    <span class="badge bg-danger" style="font-size:.65rem">Recomendado</span>
                                @endif
                                <span class="badge" style="font-size:.65rem;background:rgba(0,0,0,.55)">{{ ucfirst($it->categoria) }}</span>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex gap-3 mb-2" style="font-size:.75rem;color:#888">
                                <span><i class="fas fa-calendar-alt me-1"></i>{{ $it->duracion_dias }} días</span>
                                <span><i class="fas fa-map-marker-alt me-1"></i>{{ $it->destino_principal }}</span>
                            </div>
                            <h5 class="card-title fw-bold mb-1">{{ $it->titulo }}</h5>
                            <p class="card-text text-muted small flex-grow-1">{{ $it->descripcion_corta }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                <div>
                                    <div style="font-size:.65rem;text-transform:uppercase;color:#aaa">Desde</div>
                                    <div class="precio-destacado">{{ number_format($it->precio_desde,0,',','.') }} &euro;</div>
                                    <small class="text-muted">por persona</small>
                                </div>
                                <span class="btn btn-sm btn-outline-danger">Ver &rarr;</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-4 text-muted">No hay itinerarios destacados todavía.</div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        @include('partials.skyscanner-cta')
    </div>
</section>

{{-- COMO FUNCIONA --}}
<section class="py-5" id="como-funciona">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">¿Cómo funciona?</h2>
        <div class="row g-4 text-center">
            @foreach([
                ['n'=>'01','icon'=>'fas fa-sliders','t'=>'Dinos tus preferencias','d'=>'Duración, temática, presupuesto y si es tu primera vez.'],
                ['n'=>'02','icon'=>'fas fa-list',   't'=>'Elige tu itinerario',   'd'=>'Te mostramos los viajes que mejor encajan contigo.'],
                ['n'=>'03','icon'=>'fas fa-calendar-check','t'=>'Reserva online',  'd'=>'Selecciona fechas y número de viajeros y paga con seguridad.'],
                ['n'=>'04','icon'=>'fas fa-plane',  't'=>'Viaja a Japon',         'd'=>'Recibe tu guía en PDF y disfruta de la experiencia.'],
            ] as $p)
            <div class="col-md-6 col-lg-3">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                     style="width:60px;height:60px;background:rgba(188,0,45,.1)">
                    <i class="{{ $p['icon'] }}" style="color:#BC002D;font-size:1.3rem"></i>
                </div>
                <div style="font-size:.65rem;font-weight:700;letter-spacing:.15em;color:#BC002D;text-transform:uppercase">Paso {{ $p['n'] }}</div>
                <h6 class="fw-bold mt-1">{{ $p['t'] }}</h6>
                <p class="text-muted small">{{ $p['d'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
