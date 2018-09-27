$(document).ready(function () {
    // $( "#user_img").change(function() {
    //     var fileValue = this.value;
    //     var fileName = fileValue.split("\\");
    //     $( "#file-name").text(fileName[fileName.length-1]);
    // });


    $('.slick-img').slick({
        dots: false,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows:true,
        variableWidth: true,
        // responsive: [
        //     {
        //         breakpoint: 480,
        //         settings: {
        //             slidesToShow: 2,
        //             slidesToScroll: 1,
        //             infinite: true,
        //         }
        //     }
        // ]
    });
});












