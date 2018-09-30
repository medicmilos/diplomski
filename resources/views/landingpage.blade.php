@extends('layouts.app')

@section('content')
    <div class="container landing">
        <div class="title col-lg-8 col-center">
            <p>Podeli svoj omiljeni studentski trenutak koji ćeš obogatiti ICT stikerima. Najkreativnije fotografije
                mogu osvojiti nagradu svake nedelje.
            </p>

    </div>

        <div class="col-lg-12 row">
            <div class="col-lg-5 col-center">
                <img src="{{asset("images/1.png")}}"><br>
                <img src="{{asset("images/2.png")}}"><br>
                <img src="{{asset("images/3.png")}}">
            </div>
            <div class="col-lg-7">
                <img class="col-center" src="{{asset("images/example.png")}}">
            </div>
        </div>
    </div>

@endsection

@section('title_text')
    Početna | ICT galerija
@endsection
