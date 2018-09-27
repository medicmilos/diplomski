@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="container app-wrapper" id="app">
            <registration></registration>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
@section('title_text')
    registruj se
@endsection
