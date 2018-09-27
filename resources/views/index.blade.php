@extends(afw_service_namespace() . '::layout')
@section('content')
    <div class="col-lg-12 desktop-preloader mobile-preloader">
        <div class="container app-wrapper" id="app" style="width: 100%">
            <div class="mobile-wrapper">
                <gallery-items></gallery-items>
            </div>
        </div>
    </div>
@endsection

@push('afw_scripts_stack')
    <script src="{{ asset('js/gallery.js?v=1') }}"></script>
    <script src="{{ asset('js/nanoScrollerJS.min.js') }}"></script>
@endpush

@section('title_text')
    Prima - Galerija
@endsection