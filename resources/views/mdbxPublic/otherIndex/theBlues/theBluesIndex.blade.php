<!DOCTYPE html>
<html lang="en">

    @include('mdbxPublic.otherHeaders.theBlues.pubHeader')

    <body>
        <!--Navbar-->
        @include('mdbxPublic.otherNavigation.theBlues.pubNavTop')
        <!--Landing -->
        <section class="allBlue video-container">
            <video autoplay loop muted>
                <source src="/videos/lightRays.mov"
                type="video/mp4">
            </video>
            <div class="container-fluid">
                @include('mdbxPublic.otherIncludes.theBlues.sections.landingPage')
            </div>
        </section>
        <!-- section 1 -->
        <section>
            <div style="padding:50px 30px;">
                <div id="dimensionHelp">
                </div>
                @include('mdbxPublic.otherIncludes.theBlues.sections.3colFeatures')
            </div>
        </section>
        <!-- section 2-->
        <section>
            <div class="container-fluid">
                @include('mdbxPublic.otherIncludes.theBlues.sections.mostViewsListx')
            </div>
        </section>
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
        <script type="text/javascript" src="/customJS/carouselEvent.js"></script>
        <script type="text/javascript" src="/customJS/rellax.min.js"></script>
        <script>
        function dimensionHelper() {
            var x = "Total Width: " + screen.width + "px Total Height: "
            + screen.height + "px Window Height: "+$(window).height();
            document.getElementById("dimensionHelp").innerHTML = x;
        }
        </script>

        <script>
            //Animation init
            new WOW().init();
            //rellax
            var rellax = new Rellax('.rellax');

            //Modal
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus()
            })

            // Material Select Initialization
            $(document).ready(function () {
                $('.mdb-select').material_select();
            });
        </script>

    </body>

</html>