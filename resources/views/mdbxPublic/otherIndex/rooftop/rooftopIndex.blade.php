<!DOCTYPE html>
<html lang="en">

    @include('mdbxPublic.otherHeaders.rooftop.pubHeader')

    <body style="font-family:Roboto">
        <!--Navbar-->
        @include('mdbxPublic.otherNavigation.rooftop.pubNavTop')
        <!--Landing -->
        <section>
            @include('mdbxPublic.otherIncludes.rooftop.sections.landingPageThemes')
        </section>
        <section>
            @include('mdbxPublic.otherIncludes.rooftop.sections.mostViewsList4up')
        </section>
        <section>
            @include('mdbxPublic.otherIncludes.rooftop.sections.remHelped')
        </section>
        <section>
            @include('mdbxPublic.otherIncludes.rooftop.sections.remReasons')
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
        <script type="text/javascript" src="/customJS/rooftop/landing.js"></script>
        <script>
        function dimensionHelper() {
            var x = "Total Width: " + screen.width + "px Total Height: "
            + screen.height + "px Window Height: "+$(window).height();
            document.getElementById("dimensionHelp").innerHTML = x;
        }
        </script>
    </body>

</html>