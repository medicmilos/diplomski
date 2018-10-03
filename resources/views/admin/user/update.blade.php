@extends('layouts.admin')
@section('content')

    <div class="container">
        <form action="{{url("admin/user/edit/$user->id")}}" method="post">

            <input type="hidden" name="_token" value="{{csrf_token()}}">
            {{method_field('patch')}}
            <label for="name">Name</label>
            <input type="text" name="name" value="{{$user->name}}" id="name">
            <br>
            <label for="email">Email</label>
            <input type="text" name="email" value="{{$user->email}}" id="email">
            <br>
            <label for="password">password</label>
            <input type="text" name="password" value="{{$user->password}}" id="password">
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>
@endsection

@section('title_text')
    Izmeni korisnika | ICT galerija
@endsection
