<script type="text/javascript" src="/vendor/slick/slick.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.landingSlick').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        nextArrow: '<span class="ti-angle-right customNext"></span>',
        prevArrow: '<span class="ti-angle-left customPrev"></span>',
        responsive: [
        {
          breakpoint: 1100,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 3,
            infinite: true,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
});
</script>
