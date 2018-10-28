@extends('layouts.app')

@section('content')
    <div class="container login">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="page-title">Prijava</p>
                <div class="card">

                    <div class="card-body">
                        <form method="POST" class="loginForm" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">

                                <div class="col-md-8 col-center">
                                    <div class="input-wrapper">
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ old('email') }}" placeholder="Email adresa"

                                               autofocus>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-8 col-center">
                                    <div class="input-wrapper">
                                        <input id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" placeholder="Lozinka" >
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            Upamti me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-center">
                                    <button type="submit">
                                        Prijavi se
                                    </button>
                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                            {{--<div class="col-md-8 col-center">--}}
                            {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                            {{--Zaboravljena lozinka?--}}
                            {{--</a>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <div class="col-md-8 col-center">
                                    <a class="reg-link" href="<?php  echo url('/'); ?>/register">
                                        Nemate nalog? Registrujte se.
                                    </a>
                                </div>
                            </div>
                        </form>
                        @if($errors->all())
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $(".loginForm").click(function () {
                /*
                var fname = document.getElementById('fname').value;
                var lname = document.getElementById('lname').value;
                var age = document.getElementById('age').value;

                if (fname.length == 0) {
                    alert("Please input a first name");
                } else if (lname.length == 0) {
                    alert("Please input a last name");
                } else if (age.length == 0) {
                    alert("Please input an age");
                }
                */
            });
        });
    </script>
@endpush
@section('title_text')
    Prijava | ICT galerija
@endsection
