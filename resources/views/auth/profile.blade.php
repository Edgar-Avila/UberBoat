@extends('layouts.auth')

@section('content')
    <div class="max-w-md mx-auto w-full py-10 px-4">

        <form method="POST" action="{{ route('editProfile') }}">
            @csrf
            @method('PUT')
            <h1 class="text-center text-4xl font-bold mb-4">Perfil</h1>

            {{-- Name --}}
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Nombre Completo<span class="text-error">*</span></span>
                </div>
                <input type="text" name="name" maxlength="255" value="{{ Auth::user()->name }}"
                    class="input input-bordered w-full" required>
            </label>
            @if ($errors->has('name'))
                <small class="text-error">{{ $errors->first('name') }}</small>
            @endif

            {{-- Email --}}
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Correo<span class="text-error">*</span></span>
                </div>
                <input type="text" name="email" value="{{ Auth::user()->email }}"
                    class="input {{ $errors->has('email') ? 'input-error' : '' }} input-bordered">
                @if ($errors->has('email'))
                    <small class="text-error">{{ $errors->first('email') }}</small>
                @endif
            </label>

            {{-- Phone --}}
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Número de celular</span>
                </div>
                <input type="text" name="phone" minlength="9" maxlength="9" pattern="\d{9}" title="E.g. 987654321" value="{{ Auth::user()->phone }}"
                    class="input {{ $errors->has('phone') ? 'input-error' : '' }} input-bordered">
                @if ($errors->has('phone'))
                    <small class="text-error">{{ $errors->first('phone') }}</small>
                @endif
            </label>

            {{-- Description --}}
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Descripción</span>
                </div>
                <textarea type="text" name="description" maxlength="255" class="textarea textarea-bordered w-full">{{ Auth::user()->description }}</textarea>
            </label>
            @if ($errors->has('description'))
                <p class="text-error text-small">{{ $errors->first('description') }}</p>
            @endif

            {{-- Role --}}
            <label class="swap swap-flip my-4 w-full">
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
            <button class="btn btn-primary w-full mb-2">
                Guardar
            </button>
        </form>

        <form action="{{ route('deleteAccount') }}" method="POST" id="delete-account-form">
            @csrf
            @method('DELETE')
            <button class="btn btn-error w-full" type="button" id="delete-account-btn">
                Eliminar Cuenta
            </button>
        </form>

        {{-- Back to Map --}}
        <div class="text-center">
            <a class="btn btn-link" href="{{ route('map') }}">Volver a mapa</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/auth/profile.js') }}"></script>
@endpush
