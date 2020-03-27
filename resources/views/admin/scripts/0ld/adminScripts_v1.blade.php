<script src="/nAdminPro/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="/nAdminPro/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="/nAdminPro/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- apps js -->
<script src="/nAdminPro/dist/js/app.min.js"></script>
<script src="/nAdminPro/dist/js/app.init.js"></script>
<script src="/nAdminPro/dist/js/app-style-switcher.js"></script>

<!-- slimscrollbar scrollbar JavaScript -->
<script src="/nAdminPro/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>

<!-- sparkline needed?
<script src="/nAdminPro/assets/extra-libs/sparkline/sparkline.js"></script>
-->

<!--Wave Effects -->
<script src="/nAdminPro/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="/nAdminPro/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="/nAdminPro/dist/js/custom.min.js"></script>
<!-- synch -->
<script src="/myjs/admin/oneClickSynch.js"></script>
<script src="/myjs/admin/getNewPhotos.js"></script>
<script src="/myjs/admin/resizePhoto_w1000.js"></script>
<script src="/myjs/admin/agentPhotoLogo/createNew_agentPhoto.js"></script>
<script src="/myjs/admin/agentPhotoLogo/createNew_agentLogo.js"></script>

<!-- needed? 
<script src="/nAdminPro/dist/js/pages/dashboards/dashboard1.js"></script>
-->
<script type="text/javascript" src="/slick/slick.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    
    $('.supportSlide').slick({
        infinite: true,
        nextArrow: '<span class="fas fa-chevron-right customNext"></span>',
        prevArrow: '<span class="fas fa-chevron-left customPrev"></span>',
    });

    $('.newAddSlide').slick({
        infinite: true,
        nextArrow: '<span class="ti-angle-right customNext hidden"></span>',
        prevArrow: '<span class="ti-angle-left customPrev hidden"></span>',
        slidesToShow: 5,
        centerMode:true,
        responsive: [{
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1 
            }
        }]
    });

    /* to fix issue with carousel not showing in inactive tab */
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		$('.topViewSlide').slick('setPosition',0);
        $('.newAddSlide').slick('setPosition',0);
	});
});
</script>
<!-- My JS -->
<script src="/myjs/admin/mainAdmin.js"></script>