<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name','JapanStyle') }} - @yield('title','Acceso')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --rojo: #BC002D; }
        body { font-family: 'Montserrat', sans-serif; background: #f0ebe3; min-height: 100vh;
               display: flex; align-items: center; justify-content: center; padding: 2rem 0; }
        .auth-card { background: #fff; border-radius: 12px; box-shadow: 0 6px 24px rgba(0,0,0,0.1);
                     overflow: hidden; width: 100%; max-width: 440px; }
        .auth-header { background: var(--rojo); color: #fff; padding: 1.25rem 1.75rem; }
        .auth-header h5 { margin: 0; font-weight: 600; font-size: 1rem; }
        .auth-body { padding: 1.75rem; }
        .form-control:focus { border-color: var(--rojo); box-shadow: 0 0 0 .2rem rgba(188,0,45,.15); }
        .form-label { font-size: .82rem; font-weight: 600; color: #444; }
        .btn-rojo { background: var(--rojo); color: #fff; border: none; border-radius: 6px;
                    padding: 10px; font-weight: 600; width: 100%; transition: background .2s; }
        .btn-rojo:hover { background: #8B0000; color: #fff; }
        .link-auth { color: var(--rojo); font-weight: 600; text-decoration: none; font-size: .85rem; }
        .link-auth:hover { text-decoration: underline; }
        .brand { text-align: center; margin-bottom: 1.5rem; }
        .brand-name { font-size: 1.5rem; font-weight: 700; color: #1a1a1a; }
        .brand-name span { color: var(--rojo); }
    </style>
</head>
<body>
    <div class="w-100 px-3">
        <div class="brand">
            <a href="{{ route('home') }}" style="text-decoration:none">
                <div class="brand-name">JAPAN<span>STYLE</span></div>
            </a>
        </div>
        <div class="auth-card mx-auto">
            <div class="auth-header">
                <h5>@yield('card-title','Acceso')</h5>
            </div>
            <div class="auth-body">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
