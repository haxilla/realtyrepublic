<!DOCTYPE html>
<html lang="en">

    @include('mdbxPublic.otherHeaders.blueSmoke.pubHeader')

    <body>
        <!--Navbar-->
        @include('mdbxPublic.otherNavigation.blueSmoke.pubNavTop')
        <!--Landing -->
        <section class="blueSmokeGradAni" style="position:relative;overflow:hidden;
        margin:0;padding:0;">
            <video autoplay loop muted
            style="opacity:.3;position:absolute;width:100%;
            object-fit:cover;height:100%;">
                <source src="/videos/lightRays.mov"
                type="video/mp4">
            </video>
            <div class="container-fluid">
                @include('mdbxPublic.otherIncludes.blueSmoke.sections.landingPage')
            </div>
        </section>
        <!-- section 1 -->
        <section>
            <div style="padding:50px 30px;">
                @include('mdbxPublic.otherIncludes.blueSmoke.sections.3colFeatures')
            </div>
        </section>
        <!-- section 2-->
        <section>
            <div class="container-fluid">
                @include('mdbxPublic.otherIncludes.blueSmoke.sections.mostViewsListx')
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

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="/landingJS/mdb.min.js"></script>

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="/customJS/modernizr-custom.js"></script>
        <script type="text/javascript" src="/customJS/IEfix.js"></script>
        <script type="text/javascript" src="/customJS/carouselEvent.js"></script>
        <script type="text/javascript" src="/customJS/rellax.min.js"></script>

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