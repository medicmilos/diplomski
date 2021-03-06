@extends('layouts.app')

@section('content')
    <div class="container login register">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="page-title">Registracija</p>
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">

                                <div class="col-md-8 col-center">
                                    <div class="input-wrapper">
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ old('email') }}" placeholder="Email adresa"
                                               >
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
                                    <div class="input-wrapper">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" placeholder="Potvrdi lozinku" >
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-center">
                                    <button type="submit" class="">
                                        Registruj se
                                    </button>
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
@section('title_text')
    Registracija | ICT galerija
@endsection
