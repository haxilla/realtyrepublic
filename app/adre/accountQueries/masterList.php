<?php

//models
use App\models\core\propagent;
use App\models\core\agtoffice;
use App\models\core\propflyer;
//lastLoginAccount
$lastLoginAccountQuery=propagent::where('id','=',"$lastLoginAccount")
->select('agtUname','xxAgtUname','agtUname','id','remCreds','lastLogin',
   'startDate','expireDate','agtPhoto','agtLogo','agtPswd')
->first();
$lastLoginFlyerCount=propflyer::where('propagent_id','=',"$lastLoginAccount")
->count();
//mostFlyersAccount
$mostFlyersAccountQuery=propagent::where('id','=',"$mostFlyersAccount")
->select('id','agtFullName','accountType','xxAgtUname',
   'agtUname','agtEmail','officeID','agtPhoto','agtLogo',
   'remCreds','pCreds','startDate','expireDate','agtPswd')
->first();
$mostFlyersFlyerCount=propflyer::where('propagent_id','=',"$mostFlyersAccount")
->count();
//earliestAccount
$earliestAccountQuery=propagent::where('id','=',"$earliestAccount")
->select('agtFullName','accountType','xxAgtUname','agtUname','id',
   'startDate','expireDate','agtPhoto','agtLogo','agtPswd')
->first();
$earliestFlyerCount=propflyer::where('propagent_id','=',"$earliestAccount")
->count();
//latestAccount
$latestAccountQuery=propagent::where('id','=',"$latestAccount")
->select('agtFullName','accountType','xxAgtUname','agtUname','id',
   'startDate','expireDate','agtPhoto','agtLogo','agtPswd')
->first();
$latestFlyerCount=propflyer::where('propagent_id','=',"$latestAccount")
->count();
//mostCredits
$mostRemCredsAccountQuery=propagent::where('id','=',"$mostRemCredsAccount")
->select('id','remCreds','lastLogin','agtUname','xxAgtUname','agtUname',
   'startDate','expireDate','agtPhoto','agtLogo','agtPswd')
->first();
$mostRemCredsFlyerCount=propflyer::where('propagent_id','=',"$mostRemCredsAccount")
->count();
// set mainAccountID

$mainAccountQuery=propagent::where('id','=',"$mainAccountID")
->select('id','agtFullName','accountType','xxAgtUname',
   'agtUname','agtEmail','officeID','agtPhoto','agtLogo',
   'remCreds','pCreds','startDate','expireDate','agtPswd')
   ->first();
$mainOfficeQuery=agtoffice::where('propagent_id','=',"$mainAccountID")
->select('remailAgentID','tempOfficeID')
->first();
//other variables
$earliestStartDate      = $earliestAccountQuery['startDate'];
$latestStartDate        = $latestAccountQuery['startDate'];
$lastLoginDate          = $lastLoginAccountQuery['lastLogin'];
$agtFullName            = $mostFlyersAccountQuery['agtFullName'];
$flyerMoveCount         = $totalFlyersFound-$mostFlyerCount;
$lastLoginUsername      = $lastLoginAccountQuery['xxAgtUname'];
$remailAgentID          = $mainOfficeQuery['remailAgentID'];
$tempOfficeID           = $mainOfficeQuery['tempOfficeID'];

