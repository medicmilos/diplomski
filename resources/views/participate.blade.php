@extends('layouts.app')
@section('content')

    <div class="col-lg-12">
        <div class="container app-wrapper" id="app">
            <div class="participate-container">
                <participate class="participate-display" style="padding-top: 4rem"></participate>
                <modifyimage class="modifyimage-display"></modifyimage>
                <finishmodifyingimage class="finishmodifyingimage-display"></finishmodifyingimage>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush

@section('title_text')
    Prima - Prijavi rad
@endsection
