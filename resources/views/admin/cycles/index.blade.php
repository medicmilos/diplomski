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
        <a href="{{url("admin/cycle/insert")}}">
            <button type="button" class="btn btn-primary">Add new cycle</button>
        </a>

        <br>
        <br>

        <div class="table-wrapper">


            <table class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Lasts until</th>
                    <th>begun</th>
                    <th>allow_input</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $counter = 1
                @endphp
                @foreach($items as $item)
                    <tr>
                        <td>{{$counter}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->lasts_until}}</td>
                        <td>{{$item->begun}}</td>
                        <td>{{$item->allow_input}}</td>
                        <td><a class="btn btn-xs btn btn-default" href="update/{{$item->id}}">edit</a> <a
                                    class="btn btn-xs btn btn-danger" onclick="return confirm('Are you sure?')"
                                    href="delete/{{$item->id}}">delete</a></td>

                    </tr>
                    @php
                        $counter++
                    @endphp
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Lasts until</th>
                    <th>begun</th>
                    <th>allow_input</th>
                    <th>Actions</th>
                </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_info" id="crudTable_info" role="status" aria-live="polite">
                        Prikazano {{($items->currentpage()-1)*$items->perpage()+1}}
                        do {{$items->currentpage()*$items->perpage()}}
                        od {{$items->total()}} unosa

                    </div>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-5 hidden-print">
                    <div class="dataTables_paginate paging_simple_numbers" id="crudTable_paginate">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('title_text')
    Pregled ciklusa | ICT galerija
@endsection
