<?php
//models
Use App\models\core\propflyer;
//set
$activeAccount=0;
$thisRemCreds=0;
$creditAccount=1;
$flyerCount=0;
$flyerQuery=null;
//thisRemCreds
$thisRemCreds  = $getAgent['remCreds'];
$thisStartDate = $getAgent['startDate'];
//if any credits
if($thisRemCreds>0){
   $activeAccount=1;}
//Tabulate mostRemCredsAccount
if($thisRemCreds>$mostRemCreds){
   $mostRemCreds=$thisRemCreds;
   $mostRemCredsAccount=$thisDup;}

//thisFlyerQuery
$thisFlyerQuery=propflyer::where('id','=',"$thisDup")
->select('id')
->get();
//thisFlyerCount
$thisFlyerCount=$thisFlyerQuery->count();
$flyerIds=null;
//build flyerIds
if($thisFlyerQuery->first()){
   foreach($thisFlyerQuery as $the){
      $theID=$the['id'];
      $flyerIds[]=$theID;
   }
}
//make array
$thisAccount[$thisDup]=[
   'propagent_id'    => $thisDup,
   'remCreds'        => $thisRemCreds,
   'startDate'       => $thisStartDate,
   'activeAccount'   => $activeAccount,
   'creditAccount'   => $creditAccount,
   'flyerQuery'      => $thisFlyerQuery,
   'flyerCount'      => $thisFlyerCount,
   'flyerIds'        => $flyerIds];


