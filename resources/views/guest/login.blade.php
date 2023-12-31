@extends('layouts.guest')

@section('content')
<form action="{{ route('login') }}" method="POST" class="max-w-md mx-auto w-full py-12 px-4">
    @csrf
    <h1 class="text-4xl text-center font-bold mb-2">Iniciar Sesión</h1>

    {{-- Email --}}
    <label class="form-control w-full my-4">
        <div class="label">
            <span class="label-text">Correo</span>
        </div>
        <input type="text" name="email" class="input {{ $errors->has('email') ? 'input-error' : '' }} input-bordered">
        @if($errors->has('email'))
        <small class="text-error">{{$errors->first('email')}}</small>
        @endif
    </label>

    {{-- Password --}}
    <label class="form-control w-full my-4">
        <div class="label">
            <span class="label-text">Contraseña</span>
        </div>
        <input type="password" name="password" class="input {{ $errors->has('email') ? 'input-error' : '' }} input-bordered">
        @if($errors->has('password'))
        <small class="text-error">{{$errors->first('password')}}</small>
        @endif
    </label>

    {{-- Button --}}
    <button class="btn btn-primary my-4 w-full text-white">
        Iniciar Sesión
    </button>
    <div class="text-center">
        <span class="text-secondary">¿Aún no eres miembro?</span>
        <a href="{{ route('register') }}" class="btn btn-link p-0">Regístrate</a>
    </div>

</form>
<div class="flex items-center w-full max-w-md mx-auto w-full px-4">
    <hr class="w-full" />
    <p class="px-3 ">O</p>
    <hr class="w-full" />
</div>
<div class="my-6 space-y-2 flex justify-center">
    <a href="auth/google">
        <button aria-label="Sign in with Google" class="flex items-center gap-3 bg-indigo-400 rounded-full p-0.5 pr-4 transition-colors duration-300 hover:bg-indigo-500">
            <div class="flex items-center justify-center bg-white w-9 h-9 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                    <title>Sign in with Google</title>
                    <desc>Google G Logo</desc>
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" class="fill-google-logo-blue"></path>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" class="fill-google-logo-green"></path>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" class="fill-google-logo-yellow"></path>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" class="fill-google-logo-red"></path>
                </svg>
            </div>
            <span class="text-sm text-white tracking-wider">Iniciar sesión con Google</span>
        </button>
    </a>
</div>

<div class="my-2 space-y-2 flex justify-center">
    <a href="">
        <button aria-label="Sign in with Facebook" class="flex items-center gap-3 bg-indigo-400 rounded-full p-0.5 pr-4 transition-colors duration-300 hover:bg-indigo-500">
            <div class="flex items-center justify-center bg-white w-9 h-9 rounded-full">
                <svg width="25" height="25" fill="currentColor" class="mr-1" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1343 12v264h-157q-86 0-116 36t-30 108v189h293l-39 296h-254v759h-306v-759h-255v-296h255v-218q0-186 104-288.5t277-102.5q147 0 228 12z"></path>
                </svg>
            </div>
            <span class="text-sm text-white tracking-wider">Iniciar sesión con Facebook</span>
        </button>
    </a>
</div>
@endsection
