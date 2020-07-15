<?php

//get models
use App\models\core\propmeta;
use App\models\oldsite\oldFlyer;

//remote server with bad sk1
$oldSK1=oldFlyer::select('ufid')
->where('sk1','like','%'.'='.'%')
->orWhereNull('sk1');

$oldSK1count=$oldSK1->count();


//query
$fixSK1=propmeta::select('propflyer_id')
->whereNull('sk1')
->orWhere('sk1','like','%'.'='.'%');
//get count
$fixCount=$fixSK1->count();
//notice if not needed
if(!$fixCount){
  dd('no fix needed');}

//retrieve one record
$fixSK1=$fixSK1->take(1)->get();

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

dd($fixCount,$oldSK1count);
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
