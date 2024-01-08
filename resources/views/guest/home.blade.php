@extends('layouts.guest')

@section('content')
<div class="hero flex-grow" style="background-image: url({{ asset('img/hero.webp') }});">
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="max-w-md text-white">
            <h1 class="mb-5 text-5xl font-bold">
                <div class="typing-container">
                    <span id="feature-text">UberBoat</span>
                </div>
                <span id="sentence" class="sentence"></span>
            </h1>
            <p class="mb-5">
                Conoce las maravillas del viaje en lancha por el lago
                navegable más alto del mundo!
                Vive una experiencia inolvidable!
            </p>
            <a class="btn btn-primary" href="{{ route('register') }}">Quiero saber más!</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", async function() {
        await carousel(carouselText, "#sentence");
    });
</script>
@endsection
