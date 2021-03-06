@extends('layouts.admin')
@push('css')
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <style>
        .admin .navbar-collapse {
            padding: 0.5rem;
        }

        .admin .navbar {
            margin-top: 1rem;
        }
    </style>
@endpush
@section('content')

    <div class="container">
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
        @endif
        <div class="box col-lg-6 col-center">

            <div class="box-header with-border">
                <h3 class="box-title">Dodaj novi ciklus</h3>
            </div>
            <div class="box-body row display-flex-wrap" style="display: flex; flex-wrap: wrap;">


                <form action="store" method="post">

                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group col-xs-12">
                        <label for="name">Naziv</label>
                        <input type="text" name="name" class="form-control" value="" id="name" maxlength="30" minlength="2" pattern="^[A-z0-9\s\-\/]*$" required>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="email">Traje do</label>

                        <div id="datetimepicker1" class="col-lg-4 input-append date">
                            <input name="lasts_until" class="form-control" type="text" required>
                            <span class="add-on">
                      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                      </i>
                    </span>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="password">Počeo</label>
                        <input type="text" name="begun" class="form-control" value="0" id="" maxlength="1" minlength="1" pattern="^[0|1]$" required>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="password">Dozvoli unos</label>
                        <input type="text" name="allow_input" class="form-control" value="0" id="" maxlength="1" minlength="1" pattern="^[0|1]$" required>
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
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: 'yyyy-MM-dd hh:mm:ss',
                todayHighlight: 'TRUE'
            });
        });

    </script>
@endpush
@section('title_text')
    Dodaj ciklus | ICT galerija
@endsection
