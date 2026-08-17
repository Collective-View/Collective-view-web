<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECOSUR — @yield('title', 'Panel de Administración')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<nav class="admin-navbar">
    <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
        <img src="{{ asset('images/logo.png') }}" class="navbar-logo">
        <div class="navbar-name">
            <span class="title">Collective view</span>
            <span class="sub">Panel de Administración</span>
        </div>
    </a>

    <div class="navbar-links">
        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('admin.publicaciones.index') }}"
           class="{{ request()->routeIs('admin.publicaciones*') ? 'active' : '' }}">
            Publicaciones
        </a>
        <a href="{{ route('admin.medios.index') }}"
           class="{{ request()->routeIs('admin.medios*') ? 'active' : '' }}">
            Medios
        </a>
        <a href="{{ route('admin.clasificacion.index') }}"
           class="{{ request()->routeIs('admin.clasificacion*') || request()->routeIs('admin.etiquetas*') || request()->routeIs('admin.categorias*') ? 'active' : '' }}">
            Clasificación
        </a>
        <a href="{{ route('admin.referencias.index') }}"
           class="{{ request()->routeIs('admin.referencias*') ? 'active' : '' }}">
            Referencias
        </a>
    </div>

    <div class="navbar-right">
        <span class="navbar-user-name">{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Salir</button>
        </form>
    </div>
</nav>

@hasSection('breadcrumb')
<div class="breadcrumb">
    @yield('breadcrumb')
</div>
@endif

<main class="admin-main">

    @if(session('success'))
        <div class="alert-success">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <ul style="margin:0;padding-left:16px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

<style>
    .navbar-logo {
        width: 42px;
        height: 42px;
        object-fit: contain;
        border-radius: 8px;
        flex-shrink: 0;
    }
</style>

</body>
</html>