@extends('layouts.app')
@section('content')
    <div class="col-lg-12 desktop-preloader mobile-preloader">
        <div class="container app-wrapper" id="app" style="width: 100%">
            <div class="mobile-wrapper">
                <gallery-items></gallery-items>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush

@section('title_text')
    Prima - Galerija
@endsection