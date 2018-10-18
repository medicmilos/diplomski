@extends('layouts.app')

@section('content')
    <div class="container winners">
        <div class="col-lg-12 row">
            <div class="col-lg-12 middle-block">
                <p class="title">
                    Čestitamo nedeljnim dobitnicima!
                </p>
                <p class="description">
                    Molimo autore fotografija da nas kontaktiraju na mail <span class="red-font"><a
                                href="mailto:test@test.com">test@test.com</a></span> kako
                    bismo dogovorili sve detalje oko preuzimanja nagrade.
                </p>
            </div>
            <winners></winners>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
@section('title_text')
    Pobednici | ICT galerija
@endsection
