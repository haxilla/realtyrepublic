<?php
//set vars
$totalRemCredsFound=0;
$totalFlyersFound=0;
//mostRemCreds
$mostRemCreds=0;
$mostRemCredsAccount=0;
$remCredsAmount=0;
//mostFlyerCount
$mostFlyerCount=0;
$mostFlyersAccount=0;
//earliest Account
$earliestAccount=0;
$earliestStartDate=\Carbon\Carbon::now();
//earliest Account
$latestAccount=0;
$latestStartDate=\Carbon\Carbon::now()->subdays(8000);
//lastLogin Account (most recent)
$lastLoginAccount=0;
$lastLoginDate=\Carbon\Carbon::now()->subDays(8000);
//unlimited
$unlimitedAccount=0;
$unlimitedActive=0;
$unlimitedActiveAccount=0;
//credit based
$creditAccount=0;
$creditActive=0;
$creditActiveAmount=0;
$creditActiveAccount=0;
//catchall
$oddBall=0;
$oddBallAccount=0;
//if more than one accountType
$accountConflict=0;
//images agtPhoto / agtLogo
$imagesOK=0;
//start array to catch flyerCounts
$accountDetails=array();
