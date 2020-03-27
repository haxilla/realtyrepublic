<!DOCTYPE html>
<html lang="en">

    @include('mdbxPublic.headersFooters.pubHeader')

    <body>
        <!--Navbar-->
        @include('mdbxPublic.navigation.pubNavTop')
        <!--Landing -->
        <section class="
            @if(strpos($theme,'sunsetGrad')!==false)
                sunsetGradAni
            @else
                darkSpaceGrad
            @endif 
            video-container" style="z-index:-2">
            @if(strpos($theme,'showVideo')!==false)
                <video autoplay loop muted>
                    <source src="/videos/lightRays.mov"
                    type="video/mp4">
                </video>
            @endif
            <div class="container-fluid" style="margin-bottom:75px;">
                @include('mdbxPublic.includes.sections.landingPage')
            </div>
            @if(strpos($theme,'transBottom2')!==false)
                <div style="position:absolute;bottom:0;z-index:-1">
                    <img src="/images/patterns/transBottom3.png" 
                    style="width:100%;">
                </div>
            @elseif(strpos($theme,'transBottom')!==false)
                <div style="position:absolute;bottom:0;z-index:-1">
                    <img src="/images/pointBottom.png" 
                    style="width:100%;">
                </div>
            @endif
        </section>
        <!-- section 1 -->
        <section>
            <div style="padding:50px 30px;">
                <div id="dimensionHelp">
                </div>
                @include('mdbxPublic.includes.sections.3colFeatures')
            </div>
        </section>
        <!-- section 2-->
        <section>
            <div class="container-fluid">
                @include('mdbxPublic.includes.sections.mostViewsListx')
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