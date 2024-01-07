<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    data-theme="{{ Cookie::get('theme') === 'dark' ? 'dark' : 'corporate' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UberBoat</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @if(Cookie::get('theme') === 'dark')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
        <style>
            div:where(.swal2-container) .swal2-html-container {
                color: #e1e1e1 !important;
            }
        </style>
    @endif
    @vite('resources/css/app.css')
    @stack('styles')
</head>

<body class="antialiased">
    @yield('body')
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(Session::has('swal-msg') || Session::has('swal-title'))
    <script>
        Swal.fire({
            icon: '{{ Session::has('swal-icon') ? Session::get('swal-icon') : 'success' }}',
            title: '{{ Session::has('swal-title') ? Session::get('swal-title') : '' }}',
            text: '{{ Session::has('swal-msg') ? Session::get('swal-msg') : '' }}',
            confirmButtonText: 'Aceptar'
        })
    </script>
@endif

@vite('resources/js/app.js')
@stack('scripts')

</html>
