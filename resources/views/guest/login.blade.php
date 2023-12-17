@extends('layouts.guest')

@section('content')
    <form action="{{ route('login') }}" method="POST" class="max-w-md mx-auto w-full py-12 px-4">
        @csrf
        <h1 class="text-4xl text-center font-bold mb-2">Iniciar Sesión</h1>

        {{-- Email --}}
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Correo</span>
            </div>
            <input type="text" name="email" class="input {{ $errors->has('email') ? 'input-error' : '' }} input-bordered">
            @if($errors->has('email'))
                <small class="text-error">{{$errors->first('email')}}</small>
            @endif
        </label>

        {{-- Password --}}
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Contraseña</span>
            </div>
            <input type="password" name="password" class="input {{ $errors->has('email') ? 'input-error' : '' }} input-bordered">
            @if($errors->has('password'))
                <small class="text-error">{{$errors->first('password')}}</small>
            @endif
        </label>

        {{-- Button --}}
        <button class="btn btn-primary mt-2 w-full">
            Iniciar Sesión
        </button>
        <div class="text-center">
            <span class="text-secondary">¿Aún no eres miembro?</span>
            <a href="{{ route('register') }}" class="btn btn-link p-0">Regístrate</a>
        </div>
    </form>
@endsection
