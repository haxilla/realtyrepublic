<!DOCTYPE html>
<html lang="en" class="full-height">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,
    initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>RealtyEmails | Admin Login</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap431/css/bootstrap431.min.css" rel="stylesheet">
    <!-- icons -->
    <link href="/vendor/tifont/tifont.css" rel="stylesheet">
    <!-- custom css -->
    <link href="/my/css/admin/adminMain.css" rel="stylesheet">

</head>

<body style="overflow:hidden;">
    <div class="row" style="margin:0;padding:0;
    position:fixed;top:-125px;"> 
        @foreach($completeCamps as $the)
            <div class="col-lg-3 col-md-3 col-6" 
            style="padding:0;margin:0;">
                <img src="/hqphotos/{{$the->theMeta->zipDir}}/{{$the->theMeta->mlsDir}}/{{$the->thePhotos->first()->photoName}}" 
                style="width:100%;height:185px;object-fit:cover;
                padding:2px;">
            </div>
        @endforeach
    </div>
    <div style="background:rgba(0,0,0,.6);position:fixed;
    z-index:2;width:100%;height:100%;">
        <div class="absolute-center"
        style="background:#000;padding:15px 25px;text-align:center;
        z-index:2;color:#fff;">
            <div style="margin:5px 25px;">
                <img src="/images/remLogoO.png"
                style="max-width:300px;">
            </div>
            @include('auth.includes.adminLoginForm')
        </div>
    </div>
</body>

</html>
