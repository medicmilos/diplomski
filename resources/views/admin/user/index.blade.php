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
        <a href="{{url("admin/user/insert")}}">Add new user</a>
        <br>
        <br>
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->password}}</td>
                    <td><a href="update/{{$user->id}}">edit</a></td>
                    <td><a href="delete/{{$user->id}}">delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection

@section('title_text')
    Pregled korisnika | ICT galerija
@endsection
