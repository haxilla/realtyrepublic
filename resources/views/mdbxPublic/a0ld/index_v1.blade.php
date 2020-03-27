<!DOCTYPE html>
<html lang="en">

    @include('mdbxPublic.headersFooters.pubHeader')
    <link href="/my/css/slick/landingSlick.css" rel="stylesheet">
    <link href="/my/css/sections/sectionDivide.css" rel="stylesheet">
    <body style="font-family:Roboto">
        <!--Navbar-->
        @include('mdbxPublic.navigation.publicNavTop')
        <!--modals-->
        @include('mdbxPublic.modals.joinNowModal')
        @include('mdbxPublic.modals.passwordChangeRequestModal')
        @include('mdbxPublic.modals.loginModal')
        <!--Landing -->
        <section>
            <div class="background-blueGrayGradient">
              @include('mdbxPublic.sections.landingPage')
            </div>
        </section>
        <section>
          @include('mdbxPublic.sections.coreFeatures-6block')
        </section>
        <section>
          @include('mdbxPublic.sections.multiSlideMostViews')
        </section>
        <section id="freeTriali">
            @include('mdbxPublic.sections.sawtoothDividerWhite')
            @include('mdbxPublic.sections.freeTrialForm')
        </section>
        <section>
          @include('mdbxPublic.sections.newestList')
        </section>
        <section>
            @include('mdbxPublic.modals.agentListModal')
            @include('mdbxPublic.sections.pricePlansButtons3colv6')
        </section>
        <section>
          @include('mdbxPublic.modals.agentWallModal')
          @include('mdbxPublic.sections.memberSinceSideBySide')
        </section>

        <!--
        <section style="padding:75px;">
            @ include('mdbxPublic.sections.remReasonsXv1')
        </section>
        <section style="background:#fff;margin-bottom:25px;">
            @ include('mdbxPublic.sections.faqContent')
        </section>
        <section>
            @ include('mdbxPublic.sections.publicFooter')
            @ include('mdbxPublic.modals.startPurchaseModal')
        </section>
        -->
        <!-- SCRIPTS -->

        <!-- JQuery -->
        <script type="text/javascript"
        src="/vendor/jquery/jquery-3.4.1.min.js"></script>

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript"
        src="/vendor/bootstrap431/js/bootstrap431.min.js"></script>

        <!-- Bootstrap tooltips
        <script type="text/javascript" src="/landingJS/popper.min.js"></script>-->

        <!-- Misc JavaScript -->
        <script type="text/javascript"
        src="/my/js/public/modernizr-custom.js"></script>

        <script type="text/javascript" src="/my/js/public/IEfix.js"></script>
        <script type="text/javascript" src="/my/js/public/landing.js"></script>
        @include('mdbxPublic.scripts.slickCarousel')
        @include('mdbxPublic.scripts.landingErrors')
    </body>

</html>
