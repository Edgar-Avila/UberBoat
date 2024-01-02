@extends('layouts.auth')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.css" />
@endpush

@section('content')
    <div id="map" class="map w-full flex-grow z-0"></div>
    <button class="btn btn-circle btn-primary fixed right-4 bottom-4 text-2xl text-white" id="search-btn">
        <i class="fa fa-search" aria-hidden="true"></i>
    </button>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.js" charset="utf-8">
    </script>
    <script src="{{ asset('js/auth/map.js') }}"></script>
@endpush
