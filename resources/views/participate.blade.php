@extends('layouts.app')
@section('content')

    <div class="container app-wrapper" id="app">
        <participate class="participate-display" style="padding-top: 4rem"></participate>
        <modifyimage class="modifyimage-display"></modifyimage>
        <finishmodifyingimage class="finishmodifyingimage-display"></finishmodifyingimage>

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush

@section('title_text')
    Prijavi rad | ICT galerija
@endsection
