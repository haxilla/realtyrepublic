
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    @include('admin.headersFooters.adminHeader')
    <!-- all flyers css -->
    @include('admin.headersFooters.allFlyers')
</head>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('admin.navigation.adminFlyerEditNav')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('admin.navigation.adminSidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== 
            @ include('admin.includes.adminBreadcrumb')-->
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid scalingEditFrame">
                <!-- ============================================================== -->
                <!-- Admin Notices -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-7 col-12">
                        @include('admin.flyerEdit.fullEditMenu')
                        <div class="scalingFlyer">
                            <div class="pad35">
                            </div>
                            <div class="pad60">
                            </div>
                            @if($theTemplate=='1pc'||$theTemplate=='s1pc')
                                @include('flyers.s1pc')
                            @elseif($theTemplate=='2pb'||$theTemplate=='s2pb')
                                @include('flyers.s2pb')
                            @elseif($theTemplate=='3pt'||$theTemplate=='s3pt')
                                @include('flyers.s3pt')
                            @elseif($theTemplate=='4sp'||$theTemplate=='s4sp')
                                @include('flyers.s4sp')
                            @elseif($theTemplate=='5pt'||$theTemplate=='s5pt')
                                @include('flyers.s5pt')
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by 
                <a href="https://www.RealtyEmails.com">RealtyEmails</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    @include('admin.scripts.adminScripts')
    <!-- flyer edit script -->
    <script src="/myjs/flyers/flyerEdit.js"></script>
</body>

</html>