@extends(afw_service_namespace() . '::layout')

@section('content')
    <div class="col-lg-12">
        <div class="container app-wrapper" id="app">
            <registration :data="name"></registration>
        </div>
    </div>
@endsection
@section('afw_scripts')
    @stack('afw_scripts_stack')
    <script src="{{ asset('js/gallery.js') }}"></script>
@endsection
@section('title_text')
    Prima - Registruj se
@endsection