@extends('layouts.app')

@section('content')
    <div class="container winners">
        <div class="col-lg-12 row">
            <h1>DOBITNICI</h1>
            <div>
                <p class="title">
                    Čestitamo dnevnim dobitnicima!
                </p>
                <p class="description">
                    Molimo autore da nas kontaktiraju na mail <span class="red-font"><a
                            href="mailto:test@test.com">test@test.com</a></span> kako
                    bismo dogovorili sve detalje oko preuzimanja nagrade.
                </p>
            </div>
            <winners></winners>
        </div>
    </div>

@endsection

@section('title_text')
    Pobednici | ICT galerija
@endsection
