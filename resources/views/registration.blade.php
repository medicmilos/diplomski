@extends('layouts.app')
@section('content')
    <div class="col-lg-12">
        <div class="container app-wrapper" id="app">
            @php $a=2; @endphp
            <registration :nameold="'{!! old('firstName') !!}'" :lastnameold="'{!! old('lastName') !!}'" :placeold="'{!! old('livingPlace') !!}'"></registration>
            <div class="col-lg-6 col-center">
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
@endsection
@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
@section('title_text')
    Popuni podatke | ICT galerija
@endsection
