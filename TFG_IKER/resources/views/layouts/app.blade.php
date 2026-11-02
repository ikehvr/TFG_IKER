<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'JapanStyle') - Viajes a Japón</title>
    <meta name="description" content="@yield('meta_description', 'JapanStyle crea itinerarios personalizados para viajar a Japón con seguridad, inspiración y recomendaciones prácticas.')">
    <meta name="keywords" content="@yield('meta_keywords', 'viaje a Japón, itinerarios Japón, rutas Japón, turismo en Japón, JapanStyle')">
    <meta name="robots" content="@yield('meta_robots', 'index,follow')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta property="og:site_name" content="JapanStyle">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'JapanStyle') . ' - Viajes a Japón'))">
    <meta property="og:description" content="@yield('og_description', $__env->yieldContent('meta_description', 'JapanStyle crea itinerarios personalizados para viajar a Japón con seguridad, inspiración y recomendaciones prácticas.'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('images/logo-japanstyle.png'))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', $__env->yieldContent('og_title', trim($__env->yieldContent('title', 'JapanStyle') . ' - Viajes a Japón')))">
    <meta name="twitter:description" content="@yield('twitter_description', $__env->yieldContent('og_description', $__env->yieldContent('meta_description', 'JapanStyle crea itinerarios personalizados para viajar a Japón con seguridad, inspiración y recomendaciones prácticas.')))">
    <meta name="twitter:image" content="@yield('twitter_image', $__env->yieldContent('og_image', asset('images/logo-japanstyle.png')))">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --rojo: #BC002D; --oscuro: #1a1a1a; --claro: #f8f4ef; }
        body { font-family: 'Montserrat', sans-serif; padding-top: 70px; background: #fff; }

        .navbar { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: 700; font-size: 1.3rem; color: var(--oscuro) !important; }
        .navbar-brand span { color: var(--rojo); }
        .nav-link { font-size: 0.88rem; font-weight: 500; color: #444 !important; }
        .nav-link:hover { color: var(--rojo) !important; }
        .btn-rojo { background: var(--rojo); color: #fff; border: none; border-radius: 5px;
                    padding: 7px 20px; font-weight: 600; font-size: 0.85rem; transition: background .2s; }
        .btn-rojo:hover { background: #8B0000; color: #fff; }
        .btn-outline-rojo { border: 1.5px solid var(--rojo); color: var(--rojo); border-radius: 5px;
                            padding: 6px 18px; font-weight: 600; font-size: 0.85rem; background: transparent; }
        .btn-outline-rojo:hover { background: var(--rojo); color: #fff; }

        .card-itinerario { border: none; border-radius: 10px; overflow: hidden;
                           box-shadow: 0 3px 15px rgba(0,0,0,0.08); transition: transform .3s, box-shadow .3s; }
        .card-itinerario:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.13); }
        .card-itinerario img { height: 200px; object-fit: cover; width: 100%; }
        .precio-destacado { font-size: 1.3rem; font-weight: 700; color: var(--rojo); }

        .badge-pendiente  { background: #fff3cd; color: #856404; padding: 4px 10px; border-radius: 20px; font-size: .72rem; font-weight: 600; }
        .badge-confirmada { background: #d1e7dd; color: #0f5132; padding: 4px 10px; border-radius: 20px; font-size: .72rem; font-weight: 600; }
        .badge-cancelada  { background: #f8d7da; color: #842029; padding: 4px 10px; border-radius: 20px; font-size: .72rem; font-weight: 600; }
        .badge-completada { background: #cfe2ff; color: #084298; padding: 4px 10px; border-radius: 20px; font-size: .72rem; font-weight: 600; }

        footer { background: var(--oscuro); color: rgba(255,255,255,0.7); padding: 45px 0 20px; margin-top: 60px; }
        footer a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.88rem; line-height: 2.2; }
        footer a:hover { color: #fff; }
        footer h6 { color: #fff; font-weight: 600; margin-bottom: 0.75rem; }
        .social-btn { display: inline-flex; align-items: center; justify-content: center;
                      width: 36px; height: 36px; border-radius: 6px; background: rgba(255,255,255,0.1);
                      color: rgba(255,255,255,0.7); font-size: 1rem; transition: all .2s; text-decoration: none; }
        .social-btn:hover { background: var(--rojo); color: #fff; }

        .page-link { color: var(--rojo); }
        .page-item.active .page-link { background: var(--rojo); border-color: var(--rojo); }

        .alerta-flash { position: fixed; top: 80px; right: 20px; z-index: 9999;
                        min-width: 300px; border-radius: 8px; animation: slideIn .3s ease; }
        @keyframes slideIn { from { opacity:0; transform:translateX(30px); } to { opacity:1; transform:translateX(0); } }
    </style>
    @stack('head')
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">JAPAN<span>STYLE</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Itinerarios</a>
                    <ul class="dropdown-menu border-0 shadow-sm">
                        <li><a class="dropdown-item" href="{{ route('itinerarios.categoria', 'tradicional') }}">Japón tradicional</a></li>
                        <li><a class="dropdown-item" href="{{ route('itinerarios.categoria', 'moderno') }}">Tokio moderno</a></li>
                        <li><a class="dropdown-item" href="{{ route('itinerarios.categoria', 'anime') }}">Anime y cultura pop</a></li>
                        <li><a class="dropdown-item" href="{{ route('itinerarios.categoria', 'naturaleza') }}">Naturaleza</a></li>
                        <li><a class="dropdown-item" href="{{ route('itinerarios.categoria', 'mixto') }}">Mixto</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item fw-bold" href="{{ route('itinerarios.index') }}">Ver todos</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('sobre-nosotros') }}">Sobre nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contacto') }}">Contacto</a></li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                @auth
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                            @if(Auth::user()->profilePhotoUrl())
                                <img src="{{ Auth::user()->profilePhotoUrl() }}" alt="Perfil"
                                     style="width:32px;height:32px;border-radius:50%;object-fit:cover;border:2px solid rgba(188,0,45,.15)">
                            @else
                                <div style="width:30px;height:30px;border-radius:50%;background:var(--rojo);color:#fff;display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:700">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span style="font-size:.85rem;color:#333">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-calendar-check me-2 text-danger"></i>Mis reservas</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2 text-danger"></i>Mi perfil</a></li>
                            @if(Auth::user()->isAdmin())
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-cog me-2 text-danger"></i>Panel Admin</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-outline-rojo">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="btn-rojo">Registrarse</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

@if(session('success'))
<div class="alert alert-success alerta-flash alert-dismissible fade show shadow-sm">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alerta-flash alert-dismissible fade show shadow-sm">
    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<main>@yield('content')</main>

<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <h5 style="color:#fff;font-weight:700">JAPAN<span style="color:var(--rojo)">STYLE</span></h5>
                <p class="mt-2" style="font-size:.85rem;color:rgba(255,255,255,.5)">
                    Agencia online especializada en itinerarios temáticos para Japón. Tu viaje, tu estilo.
                </p>
                <div class="d-flex gap-2 mt-3">
                    <a href="https://www.instagram.com/japanstyle" target="_blank" class="social-btn" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/japanstyle" target="_blank" class="social-btn" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.youtube.com/@japanstyle" target="_blank" class="social-btn" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <h6>Itinerarios</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('itinerarios.categoria', 'tradicional') }}">Tradicional</a></li>
                    <li><a href="{{ route('itinerarios.categoria', 'moderno') }}">Moderno</a></li>
                    <li><a href="{{ route('itinerarios.categoria', 'anime') }}">Anime</a></li>
                    <li><a href="{{ route('itinerarios.categoria', 'naturaleza') }}">Naturaleza</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <h6>Empresa</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('sobre-nosotros') }}">Sobre nosotros</a></li>
                    <li><a href="{{ route('contacto') }}">Contacto</a></li>
                    <li><a href="{{ route('privacidad') }}">Política de privacidad</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6">
                <h6>Contacto</h6>
                <p style="font-size:.85rem">
                    <i class="fas fa-map-marker-alt me-2" style="color:var(--rojo)"></i>Av. Francia 123, Vila-real<br>
                    <i class="fas fa-phone me-2" style="color:var(--rojo)"></i>+34 643 225 530<br>
                    <i class="fas fa-envelope me-2" style="color:var(--rojo)"></i>info@japanstyle.es
                </p>
            </div>
        </div>
        <hr style="border-color:rgba(255,255,255,.1);margin-top:1.5rem">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2" style="font-size:.78rem;color:rgba(255,255,255,.3)">
            <span>&copy; {{ date('Y') }} JapanStyle &mdash; TFG DAW &bull; Iker</span>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('sobre-nosotros') }}" style="color:rgba(255,255,255,.3)">Sobre nosotros</a>
                <a href="{{ route('privacidad') }}" style="color:rgba(255,255,255,.3)">Política de privacidad</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
setTimeout(() => {
    document.querySelectorAll('.alerta-flash').forEach(el => {
        bootstrap.Alert.getOrCreateInstance(el).close();
    });
}, 4000);
</script>
@stack('scripts')
</body>
</html>
