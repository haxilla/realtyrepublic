<!DOCTYPE html>
<html lang="en">
    @include('mdbxPublic.headersFooters.pubHeader')
    <link href="/my/css/slick/landingSlick.css" rel="stylesheet">
    <link href="/my/css/sections/sectionDivide.css" rel="stylesheet">
    <body style="font-family:Roboto">
        <!--Navbar-->
        @include('mdbxPublic.navigation.publicNavTop')
        <!--modals-->
        @include('mdbxPublic.modals.overlay')
        @include('mdbxPublic.modals.joinNowModal')
        @include('mdbxPublic.modals.passwordChangeRequestModal')
        @include('mdbxPublic.modals.loginModal')
        @include('mdbxPublic.modals.agentListModal')
        @include('mdbxPublic.modals.agentWallModal')
        <!--Landing -->
        <section>
            <div class="background-blueGrayGradient">
              @include('mdbxPublic.sections.landingPage')
            </div>
        </section>
        <section>
          @include('mdbxPublic.sections.coreFeatures-6block')
        </section>
        <section id="freeTriali">
            @include('mdbxPublic.sections.freeTrialForm')
        </section>
        <section>
          @include('mdbxPublic.sections.multiSlideMostViews')
        </section>
        <section>
          @include('mdbxPublic.sections.newestList')
        </section>
        <section>
          @include('mdbxPublic.sections.unlimitedSale')
        </section>
        <section>
          @include('mdbxPublic.sections.payPerFlyer')
        </section>
        <section>
          @include('mdbxPublic.sections.remReasons')
        </section>
        <section>
          @include('mdbxPublic.sections.faqContent')
        </section>
        <section>
          @include('mdbxPublic.sections.memberSinceSideBySide')
        </section>
        <section>
          @include('mdbxPublic.sections.publicFooter')
          @include('mdbxPublic.modals.startPurchaseModal')
        </section>
        <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript"
        src="/vendor/jquery/jquery-3.4.1.min.js">
        </script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript"
        src="/vendor/bootstrap431/js/bootstrap431.min.js">
        </script>

        <!-- Bootstrap tooltips
        <script type="text/javascript" src="/landingJS/popper.min.js"></script>-->

        <!-- Misc JavaScript -->
        <script type="text/javascript"
        src="/my/js/public/modernizr-custom.js"></script>
        <!-- Perfect Scrollbar -->
        <script src="/vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"/></script>
        <!-- custom js -->
        <script type="text/javascript" src="/my/js/public/IEfix.js"></script>
        <script type="text/javascript" src="/my/js/public/landing.js"></script>
        @include('mdbxPublic.scripts.slickCarousel')
        @include('mdbxPublic.scripts.landingErrors')
    </body>

</html>
