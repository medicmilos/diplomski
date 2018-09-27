@extends(afw_service_namespace() . '::layout')
@section('content')
    <div class="col-lg-12 show-item-page">

        <div class="container">
            <div class="row">
                <div class="col-lg-6">


                    <div class="col-sm-2 col-xs-2 show-on-mob">
                        &nbsp;
                    </div>
                    <div class="col-sm-10 col-xs-10">
                        <a href="<?php  echo url('/'); ?>/Gallery/gallery/landing">

                            <div class="logo-wrapper">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <a href="<?php  echo url('/'); ?>/Gallery/gallery/index">
                        <img class=" show-imgt img-responsive" style="margin: 0 auto;"
                             src="{{ asset('images/btn_galerija.png') }}">
                    </a>
                </div>
            </div>


            <div class="bottom-wrapper col-lg-12">
                <div class="item-wrapper show-bottom-wrap col-lg-6 col-md-6 col-sm-12 col-xs-12">

                    <div class="rotate-wrapper">
                        <div class="gallery-img-wrapper">
                            <img class="gallery-item-image" src="{{$galleryItem['imageUrl']['upload']}}">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12  sub-description">


                    <p class="username">{{$galleryItem['item_data']['name']}}</p>
                    <p class="vote-count">Glasovi: <span
                                class="show-like-count">{{$galleryItem['likeCount']}}</span></p>
                    <p><img class="show-like" src="{{ asset('images/btn_glasaj.png') }}"></p>
                    <p><img class="show-share" onclick="fbShare({{$galleryItem['id']}})"
                            src="{{ asset('images/btn_share.png') }}"></p>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('afw_scripts_stack')
    {{--<script src="{{ asset('js/cropper.js') }}"></script>--}}
    <script src="{{ asset('js/gallery.js') }}"></script>
    <script src="{{ asset('js/nanoScrollerJS.min.js') }}"></script>
    {{--<script src="{{ asset('js/custom.js') }}"></script>--}}
    <script>
        $(document).ready(function () {
            let canLike = "<?php print_r($galleryItem['canLike']); ?>";

            if (!canLike)
                $(".show-like").css("opacity", "0.5");

        });

        $(".show-like").on("click", function () {
            console.log("test");
            let id = "<?php print_r($galleryItem['id']); ?>";

            let baseUrl = "<?php  echo url('/'); ?>";

            $.ajax({
                url: baseUrl + '/Gallery/api/v1/gallery/like/' + id,
                data: null,
                type: 'post',
                success: function (output) {
                    let newVal = parseInt($(".show-like-count").html()) + +1;
                    $(".show-like-count").html(newVal);
                    $(".show-like").css("opacity", "0.5");
                },
                error: function (e) {
                },
            });
        });

        function fbShare(id) {
            let url = baseUrl + "/Gallery/gallery/share/" + id;
            let fbpopup = window.open("https://www.facebook.com/sharer/sharer.php?u=" + url, "pop", "width=600, height=400, scrollbars=no");
            return false;
        }
    </script>

@endpush

@section('title_text')
    Prima - Rad
@endsection