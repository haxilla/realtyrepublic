<?php
//models
//start loop
$remailEventLog=array();
foreach($dupCheck as $thisDup){
   //queries - getAgent,flyerCount,flyerCountQuery
   include('dupCheckQueries.php');
   //lastLogin
   include(app_path().'/adre/accountQueries/lastLoginAccount.php');
   //totalFlyers
   include(app_path().'/adre/accountQueries/mostFlyersAccount.php');
   //thisStartDate
   include(app_path().'/adre/accountQueries/earliestAccount.php');
   //thisRemCreds
   include(app_path().'/adre/accountQueries/mostRemCredsAccount.php');
   //AccountTypes
   if($getAgent['accountType']<5){
      include('accountTypeLessThan5.php');
   //Credit based accounts
   }elseif($getAgent['accountType']==5){
      include('accountType5.php');
   //OddBalls
   }else{
      include('oddBalls.php');}}
   //end of foreach loop
