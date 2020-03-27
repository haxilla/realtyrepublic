<!DOCTYPE html>
<html lang="en">

    @include('mdbxPublic.headersFooters.pubHeader')

    <body style="font-family:Roboto">
        <!--Navbar-->
        @include('mdbxPublic.navigation.pubNavTop')
        <!--Landing -->
        <section>
            @include('mdbxPublic.includes.sections.landingPageThemes')
        </section>
        <section>
            @include('mdbxPublic.includes.sections.coreFeatures-6block')
        </section>
        <section style="background:#223e94;color:#fff;padding-left:50px;">
            @include('mdbxPublic.includes.modals.agentWallModal')
            @include('mdbxPublic.includes.sections.memberSinceSideBySide')
        </section>
        <section>
            @include('mdbxPublic.includes.sections.multiSlideMostViews')
        </section>
        <section style="padding:50px;" id="freeTriali">
            @include('mdbxPublic.includes.sections.freeTrialForm')
        </section>
        <section style="background:#efedff;padding:50px;">
            @include('mdbxPublic.includes.modals.agentListModal')
            @include('mdbxPublic.includes.sections.pricePlansButtons3colv6')
        </section>
        <section style="padding:75px;">
            @include('mdbxPublic.includes.sections.remReasonsXv1')
        </section>
        <section style="background:#fff;margin-bottom:25px;">
            @include('mdbxPublic.includes.sections.faqContent')
        </section>
        <section>
            @include('mdbxPublic.includes.sections.publicFooter')
        </section>
        <!-- SCRIPTS -->


        <!-- JQuery -->
        <script type="text/javascript" src="/landingJS/jquery-3.2.1.min.js"></script>

        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="/landingJS/popper.min.js"></script>

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="/landingJS/bootstrap.min.js"></script>

        <!-- MDB core JavaScript 
        <script type="text/javascript" src="/landingJS/mdb.min.js"></script>-->

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="/customJS/modernizr-custom.js"></script>
        <script type="text/javascript" src="/customJS/IEfix.js"></script>
        <script type="text/javascript" src="/customJS/landing.js"></script>
        <script type="text/javascript" src="/slick/slick.min.js"></script>
        <script>
        function dimensionHelper() {
            var x = "Total Width: " + screen.width + "px Total Height: "
            + screen.height + "px Window Height: "+$(window).height();
            document.getElementById("dimensionHelp").innerHTML = x;
        }
        </script>
        <script type="text/javascript">
        $(document).ready(function(){
            $('.your-class').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                nextArrow: '<span class="ti-control-forward theSideNext"></span>',
                prevArrow: '<span class="ti-control-backward theSidePrev"></span>',
            });
        });
        </script>
    </body>

</html>