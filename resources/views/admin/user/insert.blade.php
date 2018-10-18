@extends('layouts.admin')
@push('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

@endpush
@section('content')

    <div class="container">
        <div class="container">
            <div class="box col-lg-6 col-center">
                <div class="box-header with-border">
                    <h3 class="box-title">Dodaj novog korisnika</h3>
                </div>
                <div class="box-body row display-flex-wrap" style="display: flex; flex-wrap: wrap;">

                    <form action="store" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">


                        <div class="form-group col-xs-12">
                            <label for="name">Ime i prezime</label>
                            <input type="text" name="name" class="form-control" value="" id="name">
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" value="" id="email">
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="email">Uloge</label><br>
                            <input type="radio" name="role" value="1"> Super Admin<br>
                            <input type="radio" name="role" value="2"> Administrator<br>
                            <button class="btn btn-default disableRoles" type="button">Bez uloge</button>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="password">Lozinka</label>
                            <input type="password" name="password" class="form-control" value="" id="password">
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
    </div>
@endsection
@push('scripts')
    <script>
        $(".disableRoles").click(function () {
            document.getElementById("sub1").checked = false;
            document.getElementById("sub2").checked = false;
        });
    </script>
@endpush
@section('title_text')
    Dodaj korisnika | ICT galerija
@endsection