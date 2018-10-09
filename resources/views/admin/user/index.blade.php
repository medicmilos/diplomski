@extends('layouts.admin')
@push('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush
@section('content')
    <style>
        table, th, tr, td {
            border: 1px solid #000000;
            border-collapse: collapse;
            padding: 5px;
        }

    </style>
    <div class="container">
        <br>
        <br>
        <a href="{{url("admin/user/insert")}}">
            <button type="button" class="btn btn-primary">Dodaj novog korisnika</button>
        </a>

        <br>
        <br>

        <div class="table-wrapper">


            <table class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Ime i prezime</th>
                    <th>Email</th>
                    <th>Lozinka</th>
                    <th>Akcije</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $counter = 1
                @endphp
                @foreach($users as $user)
                    <tr>
                        <td>{{$counter}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->password}}</td>
                        <td><a class="btn btn-xs btn btn-default" href="update/{{$user->id}}">uredi</a> <a
                                    class="btn btn-xs btn btn-danger" onclick="return confirm('Da li ste sigurni?')"
                                    href="delete/{{$user->id}}">obriši</a></td>

                    </tr>
                    @php
                        $counter++
                    @endphp
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Ime i prezime</th>
                    <th>Email</th>
                    <th>Lozinka</th>
                    <th>Akcije</th>
                </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_info" id="crudTable_info" role="status" aria-live="polite">
                        Prikazano {{($users->currentpage()-1)*$users->perpage()+1}}
                        do {{$users->currentpage()*$users->perpage()}}
                        od {{$users->total()}} unosa

                    </div>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-5 hidden-print">
                    <div class="dataTables_paginate paging_simple_numbers" id="crudTable_paginate">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title_text')
    Pregled korisnika | ICT galerija
@endsection
