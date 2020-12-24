<?php
//models
Use App\models\core\propagent;
Use App\models\core\propflyer;
//start loop
foreach($dupCheck as $thisDup){
   //queries - getAgent,flyerCount,flyerCountQuery
   include('dupCheckQueries.php');
   //create array for each account
   include(app_path().'/adre/arrays/accountDetails.php');
   //set now
   $now=\Carbon\Carbon::now();
   //UnLimited Accounts
   if($getAgent['accountType']<5){
      $unlimitedAccount=1;
      //expireDate
      $expireDate=$getAgent['expireDate'];
      //if futureDate set Active
      if($expireDate>$now){
         $unlimitedActive=1;
         $unlimitedActiveAccount=$thisDup;}
   //Credit based accounts
   }elseif($getAgent['accountType']==5){
      $creditAccount=1;
      //thisRemCreds
      $thisRemCreds=$getAgent['remCreds'];
      if($thisRemCreds>0){
         $creditActive=1;
         $creditActiveAccount=$thisDup;
         $remCredsAmount=$thisRemCreds;}
      if($thisRemCreds>$mostRemCreds){
         $mostRemCreds=$thisRemCreds;
         $mostRemCredsAccount=$thisDup;}
   //catchall for trial accounts, etc.
   }else{
   //OddBall
      $oddBall=1;
      $oddBallAccount=$thisDup;}
   //Account Conflicts
   if($creditAccount==1 && $unlimitedAccount==1){
      $accountConflict=1;}
   //lastLogin
   $thisLastLogin=$getAgent['lastLogin'];
   //set lastLoginAccount
   if($thisLastLogin>$lastLoginDate){
      $lastLoginAccount=$thisDup;
      $lastLoginDate=$thisLastLogin;}
   //totalFlyers
   $totalFlyersFound=$totalFlyersFound+$thisFlyerCount;
   //mostFlyers
   if($thisFlyerCount>$mostFlyerCount){
      $mostFlyersAccount=$thisDup;
      $mostFlyerCount=$thisFlyerCount;}
   //thisStartDate
   $thisStartDate=$getAgent['startDate'];
   //earliestAccount
   if($thisStartDate<$earliestStartDate){
      $earliestAccount=$thisDup;
      $earliestStartDate=$thisStartDate;}
   //thisRemCreds
   $thisRemCreds=$getAgent['remCreds'];
   //totalRemCredsFound
   $totalRemCredsFound=$totalRemCredsFound+$thisRemCreds;
   //mostRemCreds
   if($thisRemCreds>$mostRemCreds){
      $mostRemCredsAccount=$thisDup;
      $mostRemCreds=$thisRemCreds;}}
      // end of foreach loop

//getAgent
$getAgent=propagent::select('startDate','expireDate','remCreds',
'lastLogin','accountType','agtFullName','agtPhoto','agtLogo','officeID',
'agtUname','xxAgtUname','agtEmail','remCreds','pCreds')
->where('id','=',"$thisDup")
->first();
//thisFlyerCount
$thisFlyerCount=propflyer::where('propagent_id','=',"$thisDup")
->count();
$thisFlyerCountQuery=propflyer::where('propagent_id','=',"$thisDup")
->select('id','propagent_id')
->get();
