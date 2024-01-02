@extends('layouts.auth')

@section('content')
    <form class="container mx-auto py-12 px-4" method="POST" action="{{ route('editProfile') }}">
        @csrf
        @method('PUT')
        <h1 class="text-center text-4xl font-bold mb-4">Perfil</h1>

        {{-- Email --}}
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Correo</span>
            </div>
            <input type="text" name="email" value="{{ Auth::user()->email }}"
                class="input {{ $errors->has('email') ? 'input-error' : '' }} input-bordered">
            @if ($errors->has('email'))
                <small class="text-error">{{ $errors->first('email') }}</small>
            @endif
        </label>

        {{-- Name --}}
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Nombre Completo</span>
            </div>
            <input type="text" name="name" maxlength="255" value="{{ Auth::user()->name }}"
                class="input input-bordered w-full" required>
        </label>
        @if ($errors->has('name'))
            <small class="text-error">{{ $errors->first('name') }}</small>
        @endif

        {{-- Role --}}
        <label class="swap swap-flip my-4">
            <input type="checkbox" name="passenger" {{ Auth::user()->role->isPassenger() ? 'checked' : '' }} />
            <div class="swap-on">
                <i class="fa fa-user fa-2x" aria-hidden="true"></i>
                <span>Pasajero</span>
            </div>
            <div class="swap-off">
                <i class="fa fa-ship fa-2x swap-off" aria-hidden="true"></i>
                <span>Conductor</span>
            </div>
        </label>
        @if ($errors->has('passenger'))
            <p class="text-error text-small">{{ $errors->first('passenger') }}</p>
        @endif

        {{-- Button --}}
        <button class="btn btn-primary w-full">
            Guardar
        </button>

        {{-- Back to Map --}}
        <div class="text-center">
            <a class="btn btn-link" href="{{ route('map') }}">Volver a mapa</a>
        </div>
    </form>
@endsection
