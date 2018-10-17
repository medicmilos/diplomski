@extends('layouts.admin')
@push('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush
@section('content')

    <div class="container">
        <div class="box col-lg-6 col-center">
            <div class="box-header with-border">
                <h3 class="box-title">Dodaj novog korisnika</h3>
            </div>
            <div class="box-body row display-flex-wrap" style="display: flex; flex-wrap: wrap;">

                <form action="{{url("admin/user/edit/$user->id")}}" method="post">

                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    {{method_field('patch')}}

                    <div class="form-group col-xs-12">
                        <label for="name">Ime i prezime</label>
                        <input type="text" name="name" class="form-control" value="{{$user->name}}" id="name">
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" value="{{$user->email}}" id="email">
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="email">Uloge</label><br>

                            @foreach($user->roles as $role)
                                @php ($userRole = $role->name)
                            @endforeach
                        @if(isset($userRole))
                            <input type="checkbox" name="role" value="1"
                                   @if($userRole === "Super Admin") checked @endif> Super Admin
                            <input type="checkbox" name="role" value="2"
                                   @if($userRole === "Administrator") checked @endif> Administrator
                        @else
                            <input type="checkbox" name="role" value="1"> Super Admin
                            <input type="checkbox" name="role" value="2"> Administrator
                        @endif

                    </div>
                    <div class="form-group col-xs-12">
                        <label for="password">Lozinka</label>
                        <input type="password" name="password" class="form-control" value="{{$user->password}}"
                               id="password">
                    </div>

                    <div id="saveActions" class="form-group">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">
                                <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
                                <span data-value="save_and_back">Sačuvaj</span>
                            </button>
                        </div>
                        <a href="javascript:history.back()" class="btn btn-default"><span
                                    class="fa fa-ban"></span> &nbsp;Poništi</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title_text')
    Izmeni korisnika | ICT galerija
@endsection