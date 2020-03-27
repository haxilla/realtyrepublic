<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	@include('admin.headersFooters.adminHeader')
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
        @include('admin.navigation.adminTopbar')
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
            <!-- ============================================================== -->
            <!-- @ include('admin.includes.adminBreadcrumb') -->
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid noPad">
                <!-- ============================================================== -->
                <!-- Admin Notices -->
                <!-- ============================================================== -->
                @include('admin.rows.noticeRow')
                <div class="row">
                    <div class="col-12">
                        <div class="slick-stage" id="newAddStage">
                            <div class="slickLeft slickDark hidden">
                            </div>
                            <div class="slickRight slickDark hidden">
                            </div>
                            <div class="newAddSlide">
                                @include('admin.includes.newAdds')
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        @include('admin.rows.messageTabs')
                    </div>
                    <div class="col-xl-4 col-md-6">
                        @include('admin.rows.indexListings')
                    </div>
                    <!--
                    <div class="col-xl-4 col-md-3">
                        <div style="height:100%;width:100%;
                        background:#eee;">
                            Placeholder
                        </div>
                    </div>
                    -->
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
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    @include('admin.scripts.adminScripts')
    @include('admin.modals.clickSynchModal')
    @include('admin.modals.synchPhoto_w1000modal')

</body>

</html>