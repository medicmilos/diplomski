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
                    <td>{{$item->approved}}</td>
                    <td>{{$item->getIsWinnerAttribute()}}</td>
                    <td><a href="#">edit</a> <a href="#">delete</a></td>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection

@section('title_text')
    Pregled fotografija | ICT galerija
@endsection
