@extends('layouts.app')
@section('content')
    <div class="col-lg-12 show-item-page">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-4">
                        <a href="<?php  echo url('/'); ?>/gallery/participate">
                            participate
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="<?php  echo url('/'); ?>/gallery/index">
                            gallery
                        </a>
                    </div>
                </div>
            </div>
            <div class="bottom-wrapper col-lg-12">
                <div class="item-wrapper show-bottom-wrap col-lg-6 col-md-6 col-sm-12 col-xs-12">

                    <div class="">
                        <div class="">
                            <img class="" src="{{$galleryItem['imageUrl']['upload']}}">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">


                    <p class="">{{$galleryItem['item_data']['name']}}</p>
                    <p class="">Glasovi: <span
                                class="show-like-count">{{$galleryItem['likeCount']}}</span></p>
                    <p class="show-like">like</p>
                    <p onclick="fbShare({{$galleryItem['id']}})">share</p>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
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
                url: baseUrl + '/api/v1/gallery/like/' + id,
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
            let url = baseUrl + "/gallery/share/" + id;
            let fbpopup = window.open("https://www.facebook.com/sharer/sharer.php?u=" + url, "pop", "width=600, height=400, scrollbars=no");
            return false;
        }
    </script>

@endpush

@section('title_text')
    rad
@endsection
