<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

    @include('admin.headersFooters.adminHeader')
    <!-- slick carousel -->
    <link rel="stylesheet" type="text/css" href="/vendor/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/vendor/slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="/my/css/slick/customSlick.css"/>

</head>

<body>
    <div class="dim">
    </div>
    @include('admin.overlays.mainFrame')
    <div class="wrapper">
        @include('admin.navigation.mainServer.adminNavTop')
        <div class="mainContainer">
            <div class="row">
                <div class="col-12">
                    <div class="slick-stage" id="newAddStage"
                    style="z-index:100">
                        <div style="position:absolute;width:100%;top:15px;">
                            <div class="container-fluid">
                                <div style="font-size:1.4vw;
                                font-weight:bold;padding:0 1rem;
                                color:#464555">
                                    New Adds
                                </div>
                            </div>
                        </div>
                        <div class="slickLeft slickDark hidden">
                        </div>
                        <div class="slickRight slickDark hidden">
                        </div>
                        <div class="listingSlide">
   
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="slick-stage" id="newAddStage"
                    style="top:-40px;z-index:99">
                        <div style="position:absolute;width:100%;top:15px;">
                            <div class="container-fluid">
                                <div style="padding:0 1rem;font-size:1.4vw;
                                font-weight:bold;color:#464555;">
                                    Most Views
                                </div>
                            </div>
                        </div>
                        <div class="slickLeft slickDark hidden">
                        </div>
                        <div class="slickRight slickDark hidden">
                        </div>
                        <div class="listingSlide">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    @include('admin.scripts.adminScripts')
    @include('admin.scripts.slickCarousel')
    <script src="/my/js/admin/mainServer/synch/synchStart.js"></script>
    <script src="/my/js/admin/mainServer/fixes/synchFixes.js"></script>
    <!-- for uploading admin photo -->
    <script src="/my/js/imageTools/imageTools.js"></script>
</body>

</html>
