@extends('layouts.admin')
@section('content')

    <div class="container">
        <form action="store" method="post">

            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <label for="name">Name</label>
            <input type="text" name="name" value="" id="name">
            <br>
            <label for="email">Email</label>
            <input type="text" name="email" value="" id="email">
            <br>
            <label for="password">password</label>
            <input type="text" name="password" value="" id="password">
            <br>
            <input type="submit" value="Submit">
        </form>

    </div>
@endsection

@section('title_text')
    Dodaj korisnika | ICT galerija
@endsection
