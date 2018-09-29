@extends('layouts.app')
@section('content')
    <div class="col-lg-12 show-item-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="col-sm-2 col-xs-2 show-on-mob">
                        &nbsp;
                    </div>
                    <div class="col-sm-10 col-xs-10">
                        <a href="<?php  echo url('/'); ?>/gallery/landing">
                            <div class="logo-wrapper">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="bottom-wrapper col-lg-12">
                <?php if(isset($galleryItem)){ ?>
                <div class="item-wrapper show-bottom-wrap col-lg-6 col-md-6 col-sm-12 col-xs-12">

                    <div class="rotate-wrapper">
                        <div class="gallery-img-wrapper">
                            <img class="gallery-item-image" src="{{$galleryItem['imageUrl']['upload']}}">
                        </div> 
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 sub-description">
                    <p class="thanks-message">Hvala na poslatoj fotografiji, nakon autorizacije će se naći u
                        galeriji</p>
                    <p><a href="<?php  echo url('/'); ?>/gallery/index">
                            <img class=" show-imgt img-responsive" style="margin: 0 auto;"
                                 src="{{ asset('images/btn_galerija.png') }}">
                        </a>
                    </p>
                </div>
                <?php }else{ ?>
                <p class="username"> Please insert a photo id in the url.</p>
                <?php } ?>
            </div>
        </div>
    </div>
@endsection



@section('title_text')
    Hvala | ICT galerija
@endsection
