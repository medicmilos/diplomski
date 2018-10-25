@extends('layouts.admin')
@push('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container">
        <div class="col-lg-12 row admin-dash">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>{{$users}}</h3>
                                    <span>Korisnici</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="far fa-address-card"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>{{$usersInfo}}</h3>
                                    <span>Korisnici sa podacima</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="far fa-images"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>{{$images}}</h3>
                                    <span>Fotografije</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('title_text')
    Dodaj korisnika | ICT galerija
@endsection