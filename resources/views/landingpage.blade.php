@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-center">

                            <a href="<?php  echo url('/'); ?>/gallery/participate">
                                participate
                            </a><br>
                            <a href="<?php  echo url('/'); ?>/gallery/index">
                                gallery
                            </a>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('title_text')
   početna
@endsection
