@extends('layouts.admin')
@section('content')

    <div class="container">
        <a href="{{url("admin/user/index")}}">user administration</a>
        <br>
        <br>
        <a href="{{url("admin/gallery/index")}}">gallery administration</a>

    </div>
@endsection

@section('title_text')
    Dodaj korisnika | ICT galerija
@endsection
