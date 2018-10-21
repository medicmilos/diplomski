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
                        <input type="text" name="name" class="form-control" value="{{$user->name}}" id="name"  maxlength="45" minlength="2" pattern="^[A-z0-9\s]*$" required>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{$user->email}}" id="email" maxlength="65" minlength="2" required>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="email">Uloge</label><br>

                        @foreach($user->roles as $role)
                            @php ($userRole = $role->name)
                        @endforeach
                        @if(isset($userRole))
                            <input type="radio" id="sub1" name="role" value="1"
                                   @if($userRole === "Super Admin") checked @endif> Super Admin<br>
                            <input type="radio" id="sub2" name="role" value="2"
                                   @if($userRole === "Administrator") checked @endif> Administrator<br>
                        @else
                            <input type="radio" id="sub1" name="role" value="1"> Super Admin
                            <input type="radio" id="sub2" name="role" value="2"> Administrator
                        @endif
                        <button class="btn btn-default disableRoles" type="button">Bez uloge</button>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="password">Lozinka</label>
                        <input type="password" name="password" class="form-control" value="{{$user->password}}"
                               id="password" maxlength="45" minlength="4" required>
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
@push('scripts')
    <script>
        $(".disableRoles").click(function () {
            document.getElementById("sub1").checked = false;
            document.getElementById("sub2").checked = false;
        });
    </script>
@endpush

@section('title_text')
    Izmeni korisnika | ICT galerija
@endsection
