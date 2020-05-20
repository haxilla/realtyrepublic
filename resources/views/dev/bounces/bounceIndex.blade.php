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
                <a href="/admin/bounceAuto" style="text-decoration:none;">
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
                <div>
                    INBOX {{$totalSafemail}}
                </div>
                <div style="border:1px solid #eee;
                padding:15px;margin:15px;margin-left:0;">
                    @foreach($safemail as $the)
                        <div class="hover">
                            <a href="/admin/bounceIndexDisplay?uid={{$the['uid']}}"
                            style="color:#333;text-decoration:none;
                            font-size:.75em;display:block;">
                                <div class="inlineBlock">
                                    {{$the['uid']}}
                                </div>
                                <div class="inlineBlock">
                                    @isset($the['from'])
                                        {{$the['from']}}
                                    @endisset
                                </div>
                                <div class="inlineBlock">
                                    {{$the['subject']}}
                                </div>
                            </a>
                        </div>
                        <hr style="margin:5px 0;">
                    @endforeach
                    <div class="mt15">
                        {{ $safemail->links() }}
                    </div>
                </div>
                <div>
                    REVIEW {{$totalReviewmail}}
                </div>
                <div style="border:1px solid #eee;
                padding:15px;margin:15px;margin-left:0;">
                    @foreach($reviewmail as $the)
                        <div class="hover">
                            <a href="/admin/bounceIndexDisplay?uid={{$the['uid']}}"
                            style="color:#333;text-decoration:none;
                            font-size:.75em;display:block;">
                                <div class="inlineBlock">
                                    {{$the['uid']}}
                                </div>
                                <div class="inlineBlock">
                                    @isset($the['from'])
                                        {{$the['from']}}
                                    @endisset
                                </div>
                                <div class="inlineBlock">
                                    {{$the['subject']}}
                                </div>
                            </a>
                        </div>
                        <hr style="margin:5px 0;">
                    @endforeach
                    <div class="mt15">
                        {{ $reviewmail->links() }}
                    </div>
                </div>
                <div>
                    SPAM {{$totalJunkmail}}
                </div>
                <div style="border:1px solid #eee;
                padding:15px;margin:15px;margin-left:0;">
                    @foreach($junkmail as $the)
                        <div class="hover">
                            <a href="/admin/bounceIndexDisplay?uid={{$the['uid']}}"
                            style="color:#333;text-decoration:none;
                            font-size:.75em;display:block;">
                                <div class="inlineBlock">
                                    @isset($the['from'])
                                        {{$the['from']}}
                                    @endisset
                                </div>
                                <div class="inlineBlock">
                                    {{$the['subject']}}
                                </div>
                            </a>
                        </div>
                        <hr style="margin:5px 0;">
                    @endforeach
                    <div class="mt15">
                        {{ $junkmail->links() }}
                    </div>
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