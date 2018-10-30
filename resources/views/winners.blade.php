@extends('layouts.app')
@section('content')
    <div class="container winners">
        <div class="col-lg-12 row">
            <div class="container user_manual" id="app" style="text-align: center">
                <h1>Pobednici</h1>
                <p>
                    Molimo autore dole izabranih fotografija, koje je izabrao žiri na osnovu najviše lajkovanih radova,
                    da nas kontaktiraju na mail <span class="red-font"><a
                                href="mailto:contact@milosmedic.com">contact@milosmedic.com</a></span> kako
                    bismo dogovorili sve detalje oko preuzimanja nagrade po vašem izboru.
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
