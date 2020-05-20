<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.headersFooters.adminHeader')
    <link href="/my/css/admin/bounceMain.css" rel="stylesheet">
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
            <div style="background:#223e94;color:#fff;">
                <div class="inlineBlock">
                    <a href="/admin/bounceDelete?uid={{$uid}}" 
                    style="color:#fff;padding:10px 15px;display:block;
                    text-decoration:none;"
                    class="hover">
                        Delete
                    </a>
                </div>
            </div>
            <hr>
            <div class="mainContainer">
                <div>
                    @foreach($bounceReviews as $record)
                        <div>
                            {{$record->email}} - {{$record->subject}}
                        </div>
                    @endforeach
                </div>
                <hr>
                <div>
                    <div>
                        @if(isset($bounceMessage['htmlmsg']))
                            {!!$bounceMessage['htmlmsg']!!}
                        @elseif(isset($bounceMessage['plainmsg']))
                            {!!$bounceMessage['plainmsg']!!}
                        @else
                            Error with message
                            @isset($bounceMessage['rawBody'])
                                {{$bounceMessage['rawBody']}}
                            @endisset
                        @endif
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
    <script src="/my/js/admin/bounce/mainBounce.js"></script>
    <!-- for uploading admin photo -->
    <script src="/my/js/imageTools/imageTools.js"></script>
</body>

</html>