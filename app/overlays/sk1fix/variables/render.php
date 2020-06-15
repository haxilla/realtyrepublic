<?php

//get models
use App\models\core\propmeta;
use App\models\oldsite\oldFlyer;
/*
//remote server with bad sk1
$fixOldFlyerSK1=oldFlyer::select('ufid')
->where('sk1','like','%'.'='.'%')
->get();
*/

$fixSK1=propmeta::select('propflyer_id')
->whereNull('sk1')
->orWhere('sk1','like','%'.'='.'%')
->get();

//gen password funciton
require_once(app_path().'/members/keygens/mdbxGenPswd.php');

//local propmetas table
foreach($fixSK1 as $the){
   //set value
   $digits=rand(10,20);
   $genPswd=generatePassword($digits);
   $sk1=$genPswd;
   //update
   propmeta::where('propflyer_id','=',"$the->propflyer_id")
   ->update([
      'sk1'=>$sk1,
   ]);
   oldFlyer::where('ufid','=',"$the->propflyer_id")
   ->update([
      'sk1'=>$sk1,
   ]);}

/*
//scan remote realtyemails.com
foreach($fixOldFlyerSK1 as $the){
   //set value
   $digits=rand(10,20);
   $genPswd=generatePassword($digits);
   $sk1="$genPswd";

   oldFlyer::where('ufid','=',"$the->ufid")
   ->update([
      'sk1'=>$sk1,
   ]);}
*/
