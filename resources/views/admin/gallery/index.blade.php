@extends('layouts.admin')
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
        <table>
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
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{$item->user_id}}</td>
                    <td>{{$item->item_data->name}}</td>
                    <td>{{$item->cycle_id}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->item_data->photo}}</td>
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
                    <td><a class="btn btn-xs btn-default" href="delete/{{$item->id}}">delete</a>


                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/classie.js') }}"></script>
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

        let menuLeft = document.getElementById('cbp-spmenu-s1');
        let showLeft = document.getElementById('showLeft');
        let showLeftPush = document.getElementById('showLeftPush');
        let body = document.body;

        showLeftPush.onclick = function () {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        showLeft.onclick = function () {
            classie.toggle(this, 'active');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeft');
        };

        function disableOther(button) {
            if (button !== 'showLeft') {
                classie.toggle(showLeft, 'disabled');
            }
        }
    </script>
@endpush

@section('title_text')
    Pregled fotografija | ICT galerija
@endsection
