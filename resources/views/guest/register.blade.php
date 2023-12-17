@extends('layouts.guest')

@section('content')
    <form action="{{ route('register') }}" method="POST" class="max-w-md mx-auto w-full py-12 px-4">
        @csrf
        <h1 class="text-4xl text-center font-bold mb-2">Registrarse</h1>

        @if ($errors->has('confirm'))
            <p class="text-error">Las contraseñas no coinciden</p>
        @elseif($errors->any())
            <p class="text-error">Error al registrarse</p>
        @endif

        {{-- Email --}}
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Correo</span>
            </div>
            <input type="email" name="email" maxlength="255" class="input input-bordered w-full" required>
        </label>

        {{-- Name --}}
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Nombre Completo</span>
            </div>
            <input type="text" name="name" maxlength="255" class="input input-bordered w-full" required>
        </label>

        {{-- Password --}}
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Contraseña</span>
            </div>
            <input type="password" name="password" minlength="8" class="input input-bordered" required>
        </label>

        {{-- Confirm --}}
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Repite tu contraseña</span>
            </div>
            <input type="password" name="confirm" class="input input-bordered" required>
        </label>

        {{-- Button --}}
        <button class="btn btn-primary mt-2 w-full">
            Registrarse
        </button>
        <div class="text-center">
            <span class="text-secondary">¿Ya tienes una cuenta?</span>
            <a href="{{ route('login') }}" class="btn btn-link p-0">Inicia sesión</a>
        </div>
    </form>
@endsection
