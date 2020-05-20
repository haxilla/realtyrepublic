<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.headersFooters.adminHeader')
</head>

<body>
    <div class="dim">
    </div>
    @include('admin.overlays.mainFrame')
    <div class="wrapper">
        @include('admin.navigation.adminNavTop')
        <div class="ml30">
            <div>
                <a href="/admin/bounces" style="text-decoration:none;">
                    <h1 style="font-weight:bold;color:#223e94;
                     margin:0;padding:0;">
                        BOUNCES
                    </h1>
                </a>
            </div>
            <div style="height:35px;">                
                <div class="inlineBlock" style="vertical-align:middle;">
                    <div class="small circle bg-secondary
                    text-center hover" style="color:#223e94;">
                        <a href="/admin/bounceAuto"
                        style="text-decoration:none;">
                            <i class="ti-reload"></i>
                        </a>
                    </div>
                </div>
                <div class="inlineBlock" style="vertical-align:middle;">
                    Message Count: {{$msgCount}}
                </div>
            </div>
            <hr style="margin:10px 0;">
            <div class="mainContainer">
                @foreach($result as $the)
                    <div class="hover">
                        <div class="inlineBlock">
                            @isset($the->to)
                                {{$the->to}}
                            @endisset
                        </div
                        ><div class="inlineBlock">
                            @isset($the->from)
                                {{$the->from}}
                            @endisset
                        </div>
                        <div>
                            <a href="/admin/bounceDisplay?msg={{$the->msgno}}"
                            style="color:#333;text-decoration:none;">
                                {{$the->subject}}
                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="mt15">
                    {{ $result->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    @include('admin.scripts.adminScripts')
    <script src="/my/js/admin/synch/synchStart.js"></script>
    <!-- for uploading admin photo -->
    <script src="/my/js/imageTools/imageTools.js"></script>
</body>

</html>