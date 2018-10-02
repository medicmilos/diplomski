@extends('layouts.app')
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
                    <td><input type="checkbox" class="approved" value="{{$item->id}}"
                               @if($item->approved) checked @endif ></td>


                    <td><input type="checkbox" class="winner" value="{{$item->id}}"
                                                                @if($item->getIsWinnerAttribute()) checked @endif ></td>
                    <td><a href="delete/{{$item->id}}">delete</a></td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
        $(".approved").change(function () {
            let itemValue = $(this).is(":checked");
            let itemId = $(this).val();
            let id = itemValue ? 1 : 0;

            let data = [];

            data.push(itemId);
            data.push(id);

            $.ajax({
                type: 'POST',
                url: 'update',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {data: data},
                success: function (data) {
                    console.log("uspesno");
                },
                error: function (e) {
                    console.log(e);
                }
            });
        });
        $(".winner").change(function () {
            let itemValue = $(this).is(":checked");
            let itemId = $(this).val();
            let id = itemValue ? 1 : 0;

            let data = [];

            data.push(itemId);
            data.push(id);

            $.ajax({
                type: 'POST',
                url: 'winner',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {data: data},
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
