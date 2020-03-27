<!DOCTYPE html>
<!-- class="full-height" //for introLanding -->
<html lang="en">

<head>
    @include('mdbxPublic.otherHeaders.siren.pubHeader')
</head>

<body>

    <!--Main Navigation-->
    <header>

        <!--Navbar-->
        @include('mdbxPublic.otherNavigation.siren.pubNavTop')
        <!--  uncomment for landing page as well as html class="full-height" -->
        <!-- @ include('mdbxPublic.includes.sections.intro') -->

    </header>
    <!--Main Navigation-->

    <!--Main content-->
    <main>

        <div>
            @include('mdbxPublic.otherIncludes.siren.sections.c-landingPage')
        </div>
        <div style="padding:60px">
            @include('mdbxPublic.otherIncludes.siren.sections.3colFeatures')
        </div>
        <div>
            @include('mdbxPublic.otherIncludes.siren.sections.mostViewsListx')
        </div>
        <div>
            @include('mdbxPublic.otherIncludes.siren.sections.eflyerReasons')
        </div>

        @include('mdbxPublic.navigation.megaMenuStyles')
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