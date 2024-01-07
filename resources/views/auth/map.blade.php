@extends('layouts.auth')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.css">
@endpush

@section('content')
    <div id="map" class="map w-full flex-grow z-0"></div>
    <button class="btn btn-circle btn-primary fixed right-4 bottom-4 text-2xl text-white" id="search-btn">
        @if (Auth::user()->role->isPassenger())
            <i class="fa fa-search" aria-hidden="true"></i>
        @else
            <i class="fa fa-ship" aria-hidden="true"></i>
        @endif
    </button>
    <dialog id="drivers-modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Botes Disponibles</h3>
            <div id="drivers-modal-content"></div>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.js" charset="utf-8">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
    <script>
        const user = {
            role: '{{ Auth::user()->role }}',
            @if (Auth::user()->role->isDriver())
                available: {{ \App\Models\Driver::find(Auth::id())->available ? 'true' : 'false' }}
            @endif
        }
    </script>
    <script src="{{ asset('js/auth/map.js') }}"></script>
@endpush
