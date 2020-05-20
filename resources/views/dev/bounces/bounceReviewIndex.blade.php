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
                    Message Count: {{$msgCount}} | 
                </div>
                <div class="inlineBlock" style="vertical-align:middle;
                margin-left:5px;">
                    Group By:
                </div>
                <div class="inlineBlock" style="vertical-align:middle">
                    <div style="background:#efedff;padding:5px 10px;
                    border-radius:2em;">
                        <div class="inlineBlock hover"
                        style="border-right:1px solid #fff;
                        padding-right:10px;">
                            <a href="/admin/bounceReviewIndex?groupedBy=msgID"
                            class="noDeco" style="color:#666;">
                                MsgID
                            </a>
                        </div>
                        <div class="inlineBlock hover"
                        style="border-right:1px solid #fff;
                        padding-right:10px;">
                            <a href="/admin/bounceReviewIndex?groupedBy=email"
                            class="noDeco" style="color:#666;">
                                Email
                            </a>
                        </div>
                        <div class="inlineBlock hover"
                        style="border-right:1px solid #fff;
                        padding-right:10px">
                            <a href="/admin/bounceReviewIndex?groupedBy=subject"
                            class="noDeco" style="color:#666;">
                                Subject
                            </a>
                        </div>
                        <div class="inlineBlock hover">
                            <a href="/admin/bounceReviewIndex?groupedBy=fullName"
                            class="noDeco" style="color:#666;">
                                Name
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin:10px 0;">
            <div class="mainContainer">
                <div class="mr30">
                    <table>
                    @foreach ($bounceReviews as $headerField => $bounce_list)
                        <tr>
                            <th colspan="3"
                                style="background-color: #efedff;">
                                    {{$headerField}}: {{ $bounce_list->count() }} bounces
                            </th>
                        </tr>
                        @foreach ($bounce_list as $bounce)
                            <tr>
                                <td>
                                    <a href="/admin/bounceReviewDisplay?msgIDLink={{$bounce->msgID}}">
                                        {{ $bounce->subject}}
                                    </a>
                                </td>
                                <td>{{ $bounce->email }}</td>
                                <td>{{ $bounce->fullName}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </table>
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