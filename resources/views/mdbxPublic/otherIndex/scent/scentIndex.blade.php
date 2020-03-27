<!DOCTYPE html>
<html lang="en">

    @include('mdbxPublic.otherHeaders.scent.pubHeader')

    <body style="font-family:Roboto">
        <!--Navbar-->
        @include('mdbxPublic.otherNavigation.scent.pubNavTop')
        <!--Landing -->
        <section>
            @include('mdbxPublic.otherIncludes.scent.sections.landingPageThemes')
        </section>
        <section>
            @include('mdbxPublic.otherIncludes.scent.sections.remReasons')
        </section>
        <section>
            @include('mdbxPublic.otherIncludes.scent.sections.howItWorks')
        </section>
        <section>
            @include('mdbxPublic.otherIncludes.scent.sections.multiSlideMostViews')
        </section>
        <section>
            @include('mdbxPublic.otherIncludes.scent.sections.remHelped')
        </section>
        <!-- section 1 -->
        <div style="padding:50px;text-align:center;">
            @include('mdbxPublic.navigation.megaMenuStyles')
        </div>
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
                nextArrow: '<i class="fa fa-chevron-right theSideNext"></i>',
                prevArrow: '<i class="fa fa-chevron-left theSidePrev"></i>',
            });
        });
        </script>
    </body>

</html>