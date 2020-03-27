<!DOCTYPE html>
<html lang="en">

    @include('mdbxPublic.otherHeaders.wedge.pubHeader')

    <body>
        <!--Navbar-->
        @include('mdbxPublic.otherNavigation.wedge.pubNavTop')
        <!--Landing -->
        <section style="background: linear-gradient(146deg, #223e94, #303030, #005007);
        background-size: 400% 400%;
        -webkit-animation: sunset 30s ease infinite;
        -moz-animation: sunset 30s ease infinite;
        -o-animation: sunset 30s ease infinite;
        animation: sunset 30s ease infinite;">
        <!--
        <section style="background-image:linear-gradient(-20deg,
        #b721ff 0%, #21d4fd 100%);">
        -->
            <div class="container-fluid">
                @include('mdbxPublic.otherIncludes.wedge.sections.landingPage')
            </div>
        </section>
        <!-- section 1 -->
        <section>
            <div style="padding:50px 30px;">
                @include('mdbxPublic.otherIncludes.wedge.sections.3colFeatures')
            </div>
        </section>
        <!-- section 2-->
        <section>
            <div class="container-fluid">
                @include('mdbxPublic.otherIncludes.wedge.sections.mostViewsListx')
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

        <!-- custom JavaScript -->
        <script type="text/javascript" src="/customJS/modernizr-custom.js"></script>
        <script type="text/javascript" src="/customJS/IEfix.js"></script>
        <script type="text/javascript" src="/customJS/landing.js"></script>
    </body>

</html>