<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titulo', 'WeCook')</title>
    <link rel="icon" href="{{ asset('images/logo_small_black.svg') }}" type="image/svg+xml">
    @yield('css')

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Bootstrap y estilos estáticos -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @if(Request::is('admin*'))
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @endif

    @if(Request::is('perfil*'))
        <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    @endif

    @if(Request::is('recetas/crear*') || Request::is('recetas/*/editar'))
        <link rel="stylesheet" href="{{ asset('css/crearReceta.css') }}">
    @endif

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Solo JS procesado con Vite -->
    @vite(['resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="d-flex min-vh-100 flex-column flex-lg-row position-relative"> <!-- Añadido position-relative -->
        @auth
        @if(Route::has(Route::currentRouteName()))
            <!-- Sidebar de móvil y tablet -->
            <aside id="sidebar-responsive">
                @include('layouts.navigationResponsive')
            </aside>

            <!-- Sidebar de escritorio (lg en adelante) -->
            <aside id="sidebar-desktop">
                @include('layouts.navigation')
            </aside>
        @endif
        @endauth

        
        <!-- Modal Crear Receta -->
        @include('modals.crear-receta')

        {{-- @guest
            @include('layouts.navigationGuest')
        @endguest --}}
        
        @if(Route::has(Route::currentRouteName()))
            <!-- Contenido principal -->
            <main id="mainContent" class="main-content bg-light d-flex justify-content-center align-items-start py-3 flex-grow-1 pb-5">
                <div class="container-fluid rounded-3 shadow-sm p-3 bg-white" style="max-width: 1200px;">
                    @yield('content')
                </div>
            </main>
        @else
            <!-- Contenido a pantalla completa -->
            <main class="bg-light min-vh-100 d-flex justify-content-center align-items-center w-100">
                @yield('content')
            </main>
        @endif

        <!-- Footer fuera del contenedor principal para evitar problemas de z-index -->
        @include('layouts.footer')
    </div>
    @yield('js')
    @stack('scripts')
</body>
</html>
