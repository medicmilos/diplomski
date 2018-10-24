@extends('layouts.app')
@section('content')

    <div class="container show-page">
        <div class="col-lg-12 row">
            <div class="item-wrap col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img class="" src="{{$galleryItem['imageUrl']['upload']}}">

            </div>

            <div class="outter-content col-lg-6 col-md-6 col-sm-12">
                <div class="inner-content">


                    <p class="">{{$galleryItem['item_data']['name']}}</p>
                    <p class="">Glasovi: <span
                            class="show-like-count">{{$galleryItem['likeCount']}}</span></p>
                    @if($galleryItem['canLike'])
                        <p class="show-like show-like-img"><img
                                src="{{asset("images/btn_glasaj.png")}}"></p>
                    @else
                        <p class="show-like-img"><img style="opacity: 0.5"
                                                      src="{{asset("images/btn_glasaj.png")}}"></p>
                    @endif
                    <p class="show-like-after show-like-img"><img style="opacity: 0.5"
                                                                  src="{{asset("images/btn_glasaj.png")}}"></p>
                    <p onclick="fbShare({{$galleryItem['id']}})"><img class="item-share"
                                                                      src="{{asset("images/btn_share.png")}}"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Greška!</h5>
                    <button type="button" class="modal-default-button close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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

            $(".show-like-after").hide();

        });

        $(".show-like").on("click", function () {
            let id = "<?php print_r($galleryItem['id']); ?>";

            let baseUrl = "<?php  echo url('/'); ?>";

            $.ajax({
                url: baseUrl + '/api/v1/gallery/like/' + id,
                data: null,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (output) {
                    let newVal = parseInt($(".show-like-count").html()) + +1;
                    $(".show-like-count").html(newVal);
                    $(".show-like").css("opacity", "0.5");
                    $(".show-like").hide();
                    $(".show-like-after").show();
                },
                error: function (e) {
                    $(".modal").modal('show');
                    $(".modal-body").html("Morate biti prijavljeni kako biste glasali.");
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
    Rad | ICT galerija
@endsection
