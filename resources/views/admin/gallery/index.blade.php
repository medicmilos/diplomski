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
        <div class="table-wrapper">


            <table class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>User name</th>
                    <th>Cycle id</th>
                    <th>Created at</th>
                    <th>Photo</th>
                    <th>Approved</th>
                    <th>Winner</th>
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
                        <td>{{$item->item_data->name}}</td>
                        <td>{{$item->cycle_id}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a href="#" target="_blank">
                                <img src="{{asset("storage/gallery/thumbs/".$item->item_data->photo)}}">
                            </a>
                        </td>
                        <td>


                            <input type="checkbox"
                                   class="toggle-switch"
                                   @if($item->approved) checked @endif
                                   data-id="{{$item->id}}"
                                   value="{{$item->id}}"
                                   data-type="approve"
                                   data-toggle="toggle"
                                   data-on="Approved"
                                   data-off="Not approved"
                                   data-onstyle="success"
                                   data-offstyle="default"
                            >

                            {{--<div class="toggle-group">--}}
                            {{--<label class="btn btn-success toggle-on">Approved</label>--}}
                            {{--<label class="btn btn-default active toggle-off">Not approved</label>--}}
                            {{--<span class="toggle-handle btn btn-default"></span>--}}
                            {{--</div>--}}
                        </td>


                        <td>
                            <input type="checkbox"
                                   class="toggle-switch"
                                   @if($item->getIsWinnerAttribute()) checked @endif
                                   value="{{$item->id}}"
                                   data-id="{{$item->id}}"
                                   data-type="winner"
                                   data-toggle="toggle"
                                   data-on="Winner"
                                   data-off="Not winner"
                                   data-onstyle="success"
                                   data-offstyle="default"
                            >
                        </td>
                        <td><a class="btn btn-xs btn btn-danger" onclick="return confirm('Da li ste sigurni?')"
                               href="delete/{{$item->id}}">delete</a>


                        </td>

                    </tr>
                    @php
                        $counter++
                    @endphp
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>User id</th>
                    <th>User name</th>
                    <th>Cycle id</th>
                    <th>Created at</th>
                    <th>Photo</th>
                    <th>Approved</th>
                    <th>Winner</th>
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
@push('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(".toggle-switch").change(function () {
            let id = $(this).attr('data-id');
            let value = $(this).prop('checked') === true ? 1 : 0;
            let type = $(this).attr('data-type');

            $.ajax({
                type: 'POST',
                url: 'updateToggle',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {id: id, value: value, type: type},
                success: function (data) {
                    console.log("uspesno");
                },
                error: function (e) {
                    console.log(e);
                }
            });
        });
    </script>
@endpush

@section('title_text')
    Pregled fotografija | ICT galerija
@endsection
