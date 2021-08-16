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
            <div style="background:#223e94;color:#fff;">
                <div class="inlineBlock">
                    <a href="/admin/bounceDelete?uid={{$imap_uid}}" 
                    style="color:#fff;padding:10px 15px;display:block;
                    text-decoration:none;"
                    class="hover">
                        Delete
                    </a>
                </div>
                <div class="inlineBlock hover">
                    Fix
                </div>
            </div>
            <div class="mainContainer">
                <div>
                    <div>
                        IMAP_UID: {{$imap_uid}} / MSGNO: {{$msgno}}
                    </div>
                    @isset($imap_header->toaddress)
                    	<div>
                    		TO: {{$imap_header->toaddress}}
                    	</div>
                    @endisset
                	<div>
                		FROM: {{$imap_header->fromaddress}}
                	</div>
                		SENDER: {{$imap_header->senderaddress}}
                	</div>
                    <div>
                        FINAL: {{$finalRecipient}}
                    </div>
                    <div>
                        ORIGINAL: {{$originalRecipient}}
                    </div>
                    <div>
                        To: {{$To}}
                    </div>
                    <div>
                        Deliver-To: {{$deliverTo}}
                    </div>
                    <div>
                        Resent-To: {{$resentTo}}
                    </div>
                    <div>
                        Resent-From: {{$resentFrom}}
                    </div>
                    <div>
                        Diagnostic: {{$diagnostic}}
                    </div>
                    <div>
                        SUBJECT: {{$imap_header->subject}}
                    </div>
                    @if($attachments)
                        <div>
                            Attachments:
                            @foreach($attachments as $the)
                                {{$the['fileName']}}<BR>
                            @endforeach
                        </div>
                    @endif
                </div>
                <!-- toggleagle fields with jquery -->
                <div class="attachedMsgHeader">
                    <div>
                        ATTACHED MESSAGE HEADER
                    </div>
                    <div>
                        {!! $attached_msg_header !!}
                    </div>
                </div>
                <div class="fullHeader">
                    <div>
                        HEADER
                    </div>
                    <div>
                        {!! $msg_header !!}
                    </div>
                </div>
                <div class="fullBody">
                	<div>
                		IMAP_BODY
                	</div>
                	<div>
                		{!!$imap_body!!}}
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