<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ Cookie::get('theme') === 'dark' ? 'dark' : 'corporate' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UberBoat</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

<script>
    async function typeSentence(sentence, eleRef, delay = 100) {
        const letters = sentence.split("");
        let i = 0;
        while (i < letters.length) {
            await waitForMs(delay);
            $(eleRef).append(letters[i]);
            i++
        }
        return;
    }

    function waitForMs(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    async function deleteSentence(eleRef) {
        const sentence = $(eleRef).html();
        const letters = sentence.split("");
        let i = 0;
        while (letters.length > 0) {
            await waitForMs(100);
            letters.pop();
            $(eleRef).html(letters.join(""));
        }
    }

    const carouselText = [{
            text: "tu enlace entre las islas",
            color: "red"
        },
        {
            text: "tu destino rápido",
            color: "orange"
        },
        {
            text: "tu comodidad asegurada",
            color: "yellow"
        },
        {
            text: "tu elección inteligente",
            color: "cyan"
        },
        {
            text: "tu solución de movilidad",
            color: "green"
        }
    ]

    async function carousel(carouselList, eleRef) {
        var i = 0;
        while (true) {
            updateFontColor(eleRef, carouselList[i].color)
            await typeSentence(carouselList[i].text, eleRef);
            await waitForMs(1500);
            await deleteSentence(eleRef);
            await waitForMs(500);
            i++
            if (i >= carouselList.length) {
                i = 0;
            }
        }
    }

    function updateFontColor(eleRef, color) {
        $(eleRef).css('color', color);
    }
</script>

@if(Session::has('swal-msg') || Session::has('swal-title'))
<script>
    Swal.fire({
        icon: '{{ Session::has('
        swal - icon ') ? Session::get('
        swal - icon ') : '
        success ' }}',
        title: '{{ Session::has('
        swal - title ') ? Session::get('
        swal - title ') : '
        ' }}',
        text: '{{ Session::has('
        swal - msg ') ? Session::get('
        swal - msg ') : '
        ' }}',
        confirmButtonText: 'Aceptar'
    })
</script>



@endif

@vite('resources/js/app.js')
@stack('scripts')

</html>
