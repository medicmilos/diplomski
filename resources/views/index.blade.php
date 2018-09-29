@extends('layouts.app')
@section('content')
    <div class="container" id="app">
        <gallery-items></gallery-items>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush

@section('title_text')
    Galerija | ICT galerija
@endsection
