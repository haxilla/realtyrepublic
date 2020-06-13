<?php
//models
Use App\models\core\propflyer;
//defaults
$activeAccount=0;
$unlimitedActive=0;
$unlimitedAccount=0;
$startDate=null;
$expireDate=null;
$thisFlyerCount=0;
$thisFlyerQuery=null;
$now=\Carbon\Carbon::now();
//if accountType is less than 5
$thisFlyerCount=0;
$thisFlyerQuery=null;
if ($getAgent['accountType']>1){
   //thisFlyerQuery
   $thisFlyerQuery=propflyer::where('propagent_id','=',"$thisDup")
   ->select('id')
   ->get();
   //count
   if($thisFlyerQuery){
      $thisFlyerCount=$thisFlyerQuery->count();}

   //accounts 2 or 3
   $unlimitedAccount=1;
   $startDate=$getAgent['startDate'];
   //expireDate
   $expireDate=$getAgent['expireDate'];
   //if futureDate set Active
   if($expireDate>$now){
      $activeAccount=1;
      $unlimitedActive=1;}

   //set
   $thisAccountType=$getAgent['accountType'];
   $thisStartDate=$getAgent['startDate'];
   $thisExpireDate=$getAgent['expireDate'];
   $thisRemCreds=$getAgent['remCreds'];
   $thisPcreds=$getAgent['thisPcreds'];
   $thisAgtUname=$getAgent['agtUname'];
   $thisXxAgtUname=$getAgent['xxAgtUname'];
   $flyerIds=null;
   //build flyerIds
   if($thisFlyerQuery->first()){
      foreach($thisFlyerQuery as $the){
         $theID=$the['id'];
         $flyerIds[]=$theID;
      }
   }
   //collect
   $thisAccount[$thisDup]=[
      'propagent_id'       => $thisDup,
      'activeAccount'      => $activeAccount,
      'unlimitedActive'    => $unlimitedActive,
      'accountType'        => $thisAccountType,
      'startDate'          => $thisStartDate,
      'expireDate'         => $thisExpireDate,
      'remCreds'           => $thisRemCreds,
      'pCreds'             => $thisPcreds,
      'agtUname'           => $thisAgtUname,
      'xxAgtUname'         => $thisXxAgtUname,
      'flyerCount'         => $thisFlyerCount,
      'flyerIds'           => $flyerIds,
   ];
}
