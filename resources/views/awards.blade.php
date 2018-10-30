@extends('layouts.app')

@section('content')
    <div class="container awards">
        <div class="col-lg-12 row">
            <div class="col-lg-12 middle-block">
                <div class="col-lg-12">
                    <div class="container user_manual" id="app" style="text-align: center">
                        <h1>KAKO UČESTVOVATI?</h1>
                        <p>
                            - ICT galerija je online galerija radova napravljenih uz korišćenje stikera.<br>

                        </p>
                        <p>
                            - Da biste se prijavili potrebno je da fotografišete svoj omiljeni studentski trenutak.
                        </p>
                        <p>
                            - Zatim klikom na <a  href="<?php  echo url('/'); ?>/gallery/participate">Prijavi rad</a> postavite svoju fotografiju i dodajte naše stikere.
                        </p>
                        <p>
                           - Šaljite nam vaše radove, a mi ćemo nagraditi najinteresantnije.
                        </p>

                    </div>
                </div>
                <div class="col-lg-12 awards-imgs">
                    <h1>Nagrade</h1>
                    <h2>Majice i kačketi sa štampanim obeležjima Visoke ICT škole</h2>
                    <img class="awards-shirt" src="{{asset("images/shirt.png")}}">
                    <img class="awards-cap" src="{{asset("images/cap.png")}}">

                </div>

            </div>
        </div>
    </div>
@endsection
@section('title_text')
    Nagrade | ICT galerija
@endsection
