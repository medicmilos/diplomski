@extends('layouts.app')

@section('content')
    <div class="container landing">
        <div class="title col-xs-12 col-lg-10  row col-center">
            <p>Podeli svoj omiljeni studentski trenutak koji ćeš obogatiti ICT stikerima. Najkreativnije fotografije
                mogu osvojiti nagradu svake nedelje.
            </p>
        </div>
        <div class="col-lg-12 row landing-bottom">
            <div class="col-lg-5 col-center home-imgs">
                <a class="home-manual-img" href="<?php  echo url('/'); ?>/gallery/participate"><img
                            src="{{asset("images/1.png")}}"></a><br>
                <img class="downArrow" src="{{asset("images/arrow_down.png")}}"><br>
                <a class="home-manual-img" href="<?php  echo url('/'); ?>/gallery/participate"><img
                            src="{{asset("images/2.png")}}"></a><br>
                <img class="downArrow" src="{{asset("images/arrow_down.png")}}"><br>
                <a class="home-manual-img" href="<?php  echo url('/'); ?>/gallery/awards"><img
                            src="{{asset("images/3.png")}}"></a>
            </div>
            <div class="col-lg-7 home-imgs-main">
                <a href="<?php  echo url('/'); ?>/gallery/index"><img class="col-center"
                                                                      src="{{asset("images/example.png")}}"></a>
            </div>
        </div>
    </div>
@endsection

@section('title_text')
    Početna | ICT galerija
@endsection
