@extends('layouts.app')
@section('title','Sobre Nosotros - JapanStyle')

@section('content')
<section style="background:linear-gradient(135deg,#1a1a1a 0%,#2f2f2f 100%);padding:5rem 0;color:#fff">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge rounded-pill mb-3" style="background:rgba(188,0,45,.18);color:#fff">Tu viaje a Japón con más confianza</span>
                <h1 class="fw-bold mb-3">Diseñamos itinerarios para que viajar a Japón sea más fácil, seguro y emocionante.</h1>
                <p style="color:rgba(255,255,255,.78);font-size:1.05rem;line-height:1.8">
                    En JapanStyle reunimos itinerarios temáticos, comparativas útiles y acompañamiento digital para que cada cliente encuentre un viaje a su medida sin perder tiempo ni seguridad en el proceso.
                </p>
            </div>
            <div class="col-lg-5">
                <div class="rounded-4 p-4 h-100" style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.08)">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div style="width:48px;height:48px;border-radius:14px;background:#BC002D;display:flex;align-items:center;justify-content:center">
                            <i class="fas fa-shield-heart text-white"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Compra más segura</div>
                            <div style="color:rgba(255,255,255,.65);font-size:.9rem">Checkout protegido y recibo inmediato tras el pago.</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:48px;height:48px;border-radius:14px;background:#165096;display:flex;align-items:center;justify-content:center">
                            <i class="fas fa-plane-departure text-white"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Comparación inteligente</div>
                            <div style="color:rgba(255,255,255,.65);font-size:.9rem">Te conectamos con herramientas fiables para vuelos y alojamientos.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row g-4 mb-5">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Qué hacemos</h5>
                    <p class="text-muted mb-0" style="line-height:1.8">
                        Creamos rutas adaptadas a distintos perfiles de viajero: primera vez en Japón, amantes del anime, experiencias tradicionales, naturaleza y escapadas más premium.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Cómo te ayudamos</h5>
                    <p class="text-muted mb-0" style="line-height:1.8">
                        Centralizamos la reserva del itinerario, el pago y la documentación de compra para que el cliente tenga todo claro desde el primer momento.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Por qué confiar</h5>
                    <p class="text-muted mb-0" style="line-height:1.8">
                        Apostamos por transparencia en precios, información clara sobre la reserva y colaboraciones con servicios reconocidos para completar el viaje con más tranquilidad.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-5" style="border-radius:18px;background:#f8f4ef">
        <div class="card-body p-4 p-lg-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-7">
                    <h2 class="fw-bold mb-3">Colaboramos con plataformas reconocidas como Skyscanner</h2>
                    <p class="text-muted mb-3" style="line-height:1.8">
                        Recomendamos Skyscanner para que puedas buscar vuelos y alojamientos al mejor precio posible desde una plataforma conocida y utilizada a nivel internacional. Así combinamos nuestros itinerarios con opciones de transporte y estancia competitivas.
                    </p>
                    <p class="text-muted mb-0" style="line-height:1.8">
                        Nuestro objetivo es que el cliente sienta que tiene una base fiable para organizar todo el viaje: inspiración, reserva, documentación y acceso a comparadores de confianza.
                    </p>
                </div>
                <div class="col-lg-5">
                    @include('partials.skyscanner-cta')
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        @foreach([
            ['icon' => 'fas fa-user-check', 'title' => 'Atención cercana', 'text' => 'Respondemos dudas y acompañamos al cliente antes y después de la compra.'],
            ['icon' => 'fas fa-file-invoice', 'title' => 'Recibos claros', 'text' => 'Cada compra confirmada puede consultarse con su recibo y referencia de pago.'],
            ['icon' => 'fas fa-lock', 'title' => 'Entorno seguro', 'text' => 'Protegemos los datos esenciales de la compra y mostramos información comprensible en todo momento.'],
        ] as $item)
        <div class="col-md-4">
            <div class="text-center p-4 h-100 rounded-4" style="border:1px solid rgba(188,0,45,.12)">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                     style="width:64px;height:64px;background:rgba(188,0,45,.1)">
                    <i class="{{ $item['icon'] }}" style="color:#BC002D;font-size:1.35rem"></i>
                </div>
                <h5 class="fw-bold">{{ $item['title'] }}</h5>
                <p class="text-muted mb-0">{{ $item['text'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
